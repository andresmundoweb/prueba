<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

require_once _PS_ROOT_DIR_ . '/logs/LoggerTools.php';
require_once _PS_MODULE_DIR_ . 'sincronizacionwebservices/controllers/front/ValidacionProductosBeforeFacturaSAP.php';
require_once _PS_MODULE_DIR_ . 'payphone/controllers/front/validation.php';

/**
 * @since 1.5.0
 */

require_once _PS_MODULE_DIR_ . 'sincronizacionwebservices/controllers/front/FacturaDB.php';
require_once _PS_ROOT_DIR_ . '/logs/LoggerTools.php';

class Ps_PickupinstoreValidationModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $log = null;

    public function postProcess()
    {
        $this->log = new LoggerTools();

        if ($this->context->cart->id_customer == 0 || $this->context->cart->id_address_delivery == 0 || $this->context->cart->id_address_invoice == 0 || !$this->module->active) {
            Tools::redirectLink(__PS_BASE_URI__.'order.php?step=1');
        }

        // Check that this payment option is still available in case the customer changed his address just before the end of the checkout process
        $authorized = false;
        foreach (Module::getPaymentModules() as $module) {
            if ($module['name'] == 'ps_pickupinstore') {
                $authorized = true;
                break;
            }
        }
        if (!$authorized) {
            die(Tools::displayError('This payment method is not available.'));
        }
        $customer = new Customer($this->context->cart->id_customer);
        if (!Validate::isLoadedObject($customer)) {
            Tools::redirectLink(__PS_BASE_URI__.'order.php?step=1');
        }

        $resValidateHorario = $this->isOpen();
        if (!$resValidateHorario){
            return $this->showErrors(null,"Tienda se encuentra fuera de su horario de atención.");
        }

        $customer = new Customer((int)$this->context->cart->id_customer);
        $total = $this->context->cart->getOrderTotal(true, Cart::BOTH);
        $this->module->validateOrder((int)$this->context->cart->id, Configuration::get('PS_OS_PREPARATION'), $total, $this->module->displayName, null, array(), null, false, $customer->secure_key);
        $cart = $this->context->cart;
        $resValidateArticulos = $this->validateArticulosSAP($cart);
        if ($resValidateArticulos){
            return $this->showErrors(null,$resValidateArticulos);
        }

        /********************** ADD HENRY NUEVO *********************/           
        // add for Henry Campoverde
        //$guia_numero = $this->notificarAMiPiloto($order,$cart);
        //$this->log->add("*** guia_numero: ".$guia_numero);

        $id_order = Order::getOrderByCartId($cart->id);
        $order = new Order($id_order);
        if (!Validate::isLoadedObject($order)) {
            Tools::redirect('index.php?controller=order&step=1');
        }
        
        $facturaDB = new sincronizacionwebservicesFacturaDBModuleFrontController();
        $write = array("transaction_id" => $id_order);
        $resFacturacion = $facturaDB->processFacturacionDB($order,$cart,$write);

        
        $this->log->add("EFECTIVO Pagar y recoger En Tienda - processFacturacionDB : ".$resFacturacion);
        if (!$resFacturacion) {
            $this->changeOrderStatus($order, 6); //6 Order Cancelada
            //$this->eliminarPedidoMiPiloto($guia_numero);
            //$this->reversePayphone($data->transactionId);
            return $this->showErrors(null,$this->payphone->l('Ocurrió un inconveniente al guardar datos de la orden. Disculpa las molestias. Vuelve a intentarlo más tarde.', 'validation'));
        } else {
            //$this->addNumGuiaMiPilotoOrder($order,$guia_numero);
            $this->changeOrderStatus($order, 2, true);
            Tools::redirect('index.php?controller=order-confirmation&id_cart='.$cart->id.'&id_module='.$this->module->id.'&id_order='.$this->module->currentOrder.'&key='.$customer->secure_key);
        }
        
    }

    
    function showErrors($order, $message) {

        if ($order)
            $this->changeOrderStatus($order, Configuration::get('PS_OS_CANCELED'));
        $errors[] = $message;
        $this->context->smarty->assign([
            'errors' => $errors,
        ]);
        return $this->setTemplate('module:' . $this->module->name . '/views/templates/front/errors-messages17.tpl');
    }


    function changeOrderStatus($order, $state, $send_email_hook=false) {
        ShopUrl::cacheMainDomainForShop((int) $order->id_shop);
        $order_state = new OrderState($state);

        if (!Validate::isLoadedObject($order_state)) {
            $this->errors[] = Tools::displayError('The new order status is invalid.');
        }
        $current_order_state = $order->getCurrentOrderState();
        $history = new OrderHistory();
        $history->id_order = $order->id;
        $use_existings_payment = false;
        if (!$order->hasInvoice()) {
            $use_existings_payment = true;
        }
        $history->changeIdOrderState((int) $order_state->id, $order, $use_existings_payment);
        $history->addWithemail(true);

        if ($send_email_hook) {
            $order_status = new OrderState((int) $state, (int) $this->context->language->id);
            // Hook validate order
            Hook::exec('actionValidateOrder', array(
                'cart' => $this->context->cart,
                'order' => $order,
                'customer' => $this->context->customer,
                'currency' => $this->context->currency,
                'orderStatus' => $order_status,
            ));
        }
    }

    function validateArticulosSAP($order) {
        $ValidacionProductosBeforefacturaSAP = new sincronizacionwebservicesValidacionProductosBeforeFacturaSAPModuleFrontController();
        return $ValidacionProductosBeforefacturaSAP->validate($order);
    }
}













<?php

namespace TheITNerd\Brasil\Plugin\Magento\Checkout\Block\Cart;

use Magento\Checkout\Block\Cart\LayoutProcessor;

/**
 * Class LayoutProcessorPlugin
 * @package TheITNerd\Brasil\Plugin\Magento\Checkout\Block\Cart
 */
class LayoutProcessorPlugin
{

    /**
     * @param LayoutProcessor $subject
     * @param array $jsLayout
     * @return void
     */
    public function afterProcess(
        LayoutProcessor $subject,
        array           $jsLayout
    )
    {

        unset($jsLayout['components']['block-summary']['children']['block-shipping']['children']['address-fieldsets']['children']['city']);
        unset($jsLayout['components']['block-summary']['children']['block-shipping']['children']['address-fieldsets']['children']['country_id']);
        unset($jsLayout['components']['block-summary']['children']['block-shipping']['children']['address-fieldsets']['children']['region_id']);
        unset($jsLayout['components']['block-summary']['children']['block-shipping']['children']['address-fieldsets']['children']['region']);

        $jsLayout['components']['block-summary']['children']['block-shipping']['children']['address-fieldsets']['children']['postcode']['config']['elementTmpl'] = 'TheITNerd_Brasil/ui/form/element/cepInput';


        return $jsLayout;
    }
}

<?php

namespace TheITNerd\Brasil\Plugin\Magento\Checkout\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;
use TheITNerd\Brasil\Helper\Address;
/**
 * Class LayoutProcessorPlugin
 * @package TheITNerd\Brasil\Plugin\Magento\Checkout\Block\Checkout
 */
class LayoutProcessorPlugin
{

    /**
     * @param Address $addressHelper
     */
    public function __construct(
        private readonly Address $addressHelper
    )
    {
    }

    /**
     * @param LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        LayoutProcessor $subject,
        array           $jsLayout
    )
    {

        //Change shipping address fields
        $this->changeAddressFormInputTemplates($jsLayout['components']["checkout"]["children"]["steps"]["children"]["shipping-step"]["children"]["shippingAddress"]["children"]["shipping-address-fieldset"]["children"])
            ->modifyAddressStreetFields($jsLayout['components']["checkout"]["children"]["steps"]["children"]["shipping-step"]["children"]["shippingAddress"]["children"]["shipping-address-fieldset"]["children"]);

        //change payment method billing address fields
        foreach ($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'] as &$paymentMethod) {
            if (isset($paymentMethod['children']['form-fields']['children'])) {
                $this->changeAddressFormInputTemplates($paymentMethod['children']['form-fields']['children'])
                    ->modifyAddressStreetFields($paymentMethod['children']['form-fields']['children']);
            }
        }

        //change payment page billing address fields
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']["children"]["afterMethods"]["children"]["billing-address-form"]["children"]["form-fields"]['children'])) {
            $this->changeAddressFormInputTemplates($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']["children"]["afterMethods"]["children"]["billing-address-form"]["children"]["form-fields"]['children'])
                ->modifyAddressStreetFields($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']["children"]["afterMethods"]["children"]["billing-address-form"]["children"]["form-fields"]['children']);
        }


        return $jsLayout;
    }

    /**
     * @param array $data
     * @return $this
     */
    protected function modifyAddressStreetFields(array &$data): self
    {
        foreach ($data['street']['children'] as $key => &$streetLine) {
            $streetLine['label'] = __($this->addressHelper->getFieldLabel($key));
            $streetLine['validation']['required-entry'] = $this->addressHelper->getFieldIsRequired($key);
        }

        $data['telephone']['sortOrder'] = 45;
        $data['vat_id']['sortOrder'] = 50;
        $data['postcode']['sortOrder'] = 65;
        $data['city']['sortOrder'] = 75;
        $data['region_id']['sortOrder'] = 80;
        $data['country_id']['sortOrder'] = 85;

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    protected function changeAddressFormInputTemplates(array &$data): self
    {

        $data['postcode']['config']['elementTmpl'] = 'TheITNerd_Brasil/ui/form/element/cepInput';
        $data['vat_id']['config']['elementTmpl'] = 'TheITNerd_Brasil/ui/form/element/cpfCnpjInput';
        $data['telephone']['config']['elementTmpl'] = 'TheITNerd_Brasil/ui/form/element/telephoneInput';

        return $this;

    }
}

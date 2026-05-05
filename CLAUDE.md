# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

`TheITNerd_Brasil` (composer name `the_it_nerd/module-brasil`) — a Magento 2 module that nationalizes the storefront for Brazil: CPF/CNPJ/CEP/phone validation and masks, ViaCEP-based address autocomplete, a 4-line Brazilian street form, and an IBGE-sourced municipalities (`brazil_county`) table exposed over GraphQL.

This repo contains only the module source. It is not standalone — it must be installed inside a Magento 2 application to run, and there are no tests, lint config, or build scripts in the repo itself. Verification happens via Magento CLI inside the host app:

```bash
bin/magento setup:upgrade               # registers module, runs db_schema + data patches
bin/magento setup:di:compile            # required after changes to di.xml or class signatures
bin/magento setup:static-content:deploy # required after changes under view/
bin/magento cache:clean
```

The module's `setup:upgrade` calls out to `https://servicodados.ibge.gov.br` (IBGE) to populate `brazil_county`, so the host needs network access on first install.

## Hard dependency: TheITNerd_Core

`etc/module.xml` declares a `<sequence>` on `TheITNerd_Core` and several integration points consume Core APIs — they are not optional:

- `Model/Clients/ViaCEP/ViaCEPClient` implements `TheITNerd\Core\Api\Adapters\PostcodeClientInterface` and is registered into `TheITNerd\Core\Model\Config\PostcodeAdapters` via `etc/di.xml`. Postcode searches go through Core's adapter registry; ViaCEP is one adapter among potentially many.
- The CEP UI template (`view/frontend/web/template/ui/form/element/cepInput.html`) initializes `TheITNerd_Core/js/postcode`, and `cpfCnpjField.js` requires `TheITNerd_Core/js/inputMask`. Front-end masking/postcode wiring lives in Core; this module just declares the form elements.

When changing postcode or input-mask behavior, check whether the right fix is in Core rather than here.

## Architecture

**Form-element replacement via LayoutProcessor plugins.** The module does not fork checkout templates — it injects custom Knockout `elementTmpl` paths (`TheITNerd_Brasil/ui/form/element/{cepInput,cpfCnpjInput,telephoneInput}`) into the `jsLayout` tree:

- `Plugin/Magento/Checkout/Block/Cart/LayoutProcessorPlugin` — only swaps the postcode template in the cart shipping estimator.
- `Plugin/Magento/Checkout/Block/Checkout/LayoutProcessorPlugin` — swaps postcode + vat_id (CPF/CNPJ) + telephone, **and** rewrites street line labels/required flags from `Helper\Address::STREET_ADDRESS_CONFIG`, **and** reorders fields (telephone 45 → vat_id 50 → postcode 65 → city 75 → region 80 → country 85). It walks three different jsLayout subtrees: shipping address, each payment method's billing form, and the standalone payment-page billing form. When adding a new replacement, apply it in all three places.

**Street is 4 lines, not Magento's default.** `Setup/Patch/Data/UpdateAddressStreetLinesNumber` sets `customer/address/street_lines` to 4 and updates the `street` EAV attribute's `multiline_count`. The fixed slot order is `Street | Number | Complement | Neighborhood` (defined in `Helper\Address::STREET_ADDRESS_CONFIG`, with index 2 = Complement being the only optional one). All checkout layout rewrites and overridden phtml templates assume this order — do not change ordering without updating the helper.

**Validation as a mage/validation mixin.** `view/frontend/web/js/validation-mixin.js` is wired through `requirejs-config.js` to extend Magento's validator with `validate-cpf`, `validate-cnpj`, `validate-cpf-cnpj`, `validate-cep`, and `validate-brazilian-phone`. Adding a Brazilian validator means extending this mixin, not creating a new module.

**Brazil county / IBGE data.** Standard Magento repository pattern (`Api/Data/BrazilCountyInterface` + `BrazilCountyRepositoryInterface`, `Model/Data/BrazilCounty[Repository]`, `Model/ResourceModel/BrazilCounty[/Collection]`), bound in `etc/di.xml`. Data is loaded by `Setup/Patch/Data/PopulateBrazilCountyTable` from `https://servicodados.ibge.gov.br/api/v1/localidades/municipios?view=nivelado` and exposed through GraphQL as the `brazilCounties(filters: [...])` query (resolver: `Model/Resolver/BrazilCounties`, schema: `etc/schema.graphqls`). Filters are passed straight through to `SearchCriteriaBuilder`, so `field` names map to DB column names.

**Phtml overrides under `view/frontend/templates/Magento/...`** (Customer register, address edit, Company account create) are full template overrides of upstream Magento files, kept here to add CPF/CNPJ widgets and the 4-line street layout. When upgrading Magento, diff these against the upstream versions of the same paths.

## Conventions

- PHP 8.1+ idioms: constructor property promotion + `readonly` are used throughout (e.g. `Helper/Address`, `ViaCEPClient`, the data patches). Match this style in new classes.
- User-facing strings are English in code and translated in `i18n/pt_BR.csv` — keep the English source identifiers and add translations there rather than hardcoding Portuguese.

ALTER TABLE `customers` ADD `freightforwarderemail` TEXT NOT NULL AFTER `lastmodifiedon`, ADD `freightforwardername` TEXT NOT NULL AFTER `frieghtforwarderemail`, ADD `notifyparty` TEXT NOT NULL AFTER `frieghtforwardername`, ADD `hasshippingmark` BOOLEAN NOT NULL AFTER `notifyparty`, ADD `shippingmarkname` TEXT NOT NULL AFTER `hasshippingmark`, ADD `shippingmarktemplatepath` TEXT NOT NULL AFTER `shippingmarkname`;
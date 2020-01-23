<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class ContainerScheduleDateType extends BasicEnum{
	const eta = "ETA";
	const confirmed_delivery = "Confirmed Delivery";
	const notification_pickup = "Notification Pickup";
	const requested_delivery = "Requested Delivery";
}
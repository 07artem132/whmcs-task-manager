<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 17.12.2017
 * Time: 17:29
 */

namespace WHMCS\Module\Addon\TaskManager\Traits;

trait IsRequestMethodTraits {

	protected function isRequestMethod( $Method ) {
		if ( $_SERVER['REQUEST_METHOD'] === $Method ) {
			return true;
		}

		return false;
	}
}
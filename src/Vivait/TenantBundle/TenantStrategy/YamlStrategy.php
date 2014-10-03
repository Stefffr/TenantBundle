<?php

namespace Vivait\TenantBundle\TenantStrategy;

use Symfony\Component\Yaml\Yaml;
use Vivait\TenantBundle\Model\Tenant;
use spec\Vivait\TenantBundle\TenantStrategy\YamlStrategySpec;

/**
 * @see YamlStrategySpec
 */
final class YamlStrategy implements TenantStrategy
{
	/**
	 * @var string
	 */
	private $resource;

	public function __construct($resource = null)
	{
		$this->resource = $resource;
	}

	public function setResource($resource) {
		$this->resource = $resource;
	}

	public function loadTenants() {
		$yaml = Yaml::parse(file_get_contents($this->resource));

		$tenants = [];

		// Convert them to Tenant objects
		foreach ($yaml as $tenant) {
			$tenants[$tenant] = new Tenant($tenant);
		}

		return $tenants;
	}
}
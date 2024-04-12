<?php

declare(strict_types=1);

namespace Web200\DynamicWidget\Plugin;

use Magento\Widget\Model\Config\Converter;

/**
 * Class SetSpecificElement
 *
 * @package   Web200\DynamicWidget\Plugin
 * @author    Web200 <contact@web200.fr>
 * @copyright 2024 Web200
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://www.web200.fr/
 */
class SetSpecificElement
{
    /**
     * After convert
     *
     * @param Converter $subject
     * @param array     $result
     * @param           $source
     *
     * @return array
     */
    public function afterConvert(Converter $subject, array $result, $source): array
    {
        foreach ($result as &$item) {
            if (!isset($item['parameters'])) {
                continue;
            }
            foreach ($item['parameters'] as &$parameter) {
                if (!isset($parameter['helper_block'])) {
                    continue;
                }
                if (isset($parameter['helper_block']['data']['element'])) {
                    $parameter['type'] = $parameter['helper_block']['data']['element'];
                }
            }
        }

        return $result;
    }
}

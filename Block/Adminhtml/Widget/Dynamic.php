<?php

declare(strict_types=1);

namespace Web200\DynamicWidget\Block\Adminhtml\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class Dynamic
 *
 * @package   Web200\Dynamic\Block\Adminhtml\Widget
 * @author    Web200 <contact@web200.fr>
 * @copyright 2021 Web200
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://www.web200.fr/
 */
class Dynamic extends Widget
{
    /**
     * Object manager
     *
     * @var ObjectManagerInterface $objectManager
     */
    protected $objectManager;

    /**
     * Dynamic constructor.
     *
     * @param ObjectManagerInterface $objectManager
     * @param Context                                   $context
     * @param array                                     $data
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->objectManager = $objectManager;
    }

    /**
     * Prepare chooser element HTML
     *
     * @param AbstractElement $element Form Element
     *
     * @return AbstractElement
     */
    public function prepareElementHtml(AbstractElement $element): AbstractElement
    {
        $collection = $this->objectManager->get($this->getData('collection'));
        if ($collection instanceof OptionSourceInterface) {
            $element->setData('options', $collection->toOptionArray());
        }

        $element->setData('label', $this->getData('label'));

        $labelAddRow = (string)$this->getData('label_add_row');
        if ($labelAddRow === '') {
            $labelAddRow = __('Add new Row');
        }
        $element->setData('label_add_row', $labelAddRow);
        $labelRemoveRow = (string)$this->getData('label_remove_row');
        if ($labelRemoveRow === '') {
            $labelRemoveRow = __('Remove Row');
        }
        $element->setData('label_remove_row', $labelRemoveRow);

        return $element;
    }

    /**
     * Get label
     */
    public function getLabel(): string
    {
        return $this->getData('label');
    }
}

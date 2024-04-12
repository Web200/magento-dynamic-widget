<?php

declare(strict_types=1);

namespace Web200\DynamicWidget\Block\Adminhtml\Widget;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Select
 *
 * @package   Web200\DynamicWidget\Block\Adminhtml\Widget
 * @author    Web200 <contact@web200.fr>
 * @copyright 2024 Web200
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://www.web200.fr/
 */
class Select extends Template implements RendererInterface
{
    /**
     * Select constructor.
     *
     * @param Factory          $elementFactory
     * @param Template\Context $context
     * @param array            $data
     */
    public function __construct(
        protected Factory $elementFactory,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Render
     *
     * @param AbstractElement $element
     *
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $this->_element = $element;

        $content = '<fieldset class="dynamic fieldset admin__fieldset fieldset-wide fieldset-widget-options"><legend>' . $element->getLabel() . '</legend>';
        $content .= '<div class="content">';

        $values = explode(',', $element->getValue());
        if (is_array($values) && !empty($values)) {
            foreach ($values as $value) {
                if (empty($value)) {
                    continue;
                }
                $content .= $this->getElementInput($element, $value);
            }
        }

        $content .= '</div>';
        $content .= $this->getElementInput($element, null, true);
        $content .= $this->getAddRow($element);
        $content .= '</fieldset>';

        return $content;
    }

    /**
     * Get input
     *
     * @param      $element
     * @param null $value
     * @param bool $clone
     *
     * @return mixed
     */
    protected function getElementInput($element, $value = null, $clone = false)
    {
        try {
            $select = $this->elementFactory->create('select')
                ->setForm($element->getForm())
                ->setName($element->getName() . '[]')
                ->setValues($element->getOptions())
                ->setValue($value);
            return $this->getLayout()->createBlock(Template::class)
                ->setTemplate('Web200_DynamicWidget::select.phtml')
                ->setSelect($select)
                ->setLabelRemoveRow($element->getLabelRemoveRow())
                ->setClone($clone)
                ->toHtml();
        } catch (LocalizedException $exception) {
            return '';
        }
    }

    /**
     * Get add row
     *
     * @param $element
     *
     * @return mixed
     */
    protected function getAddRow($element)
    {
        try {
            return $this->getLayout()->createBlock(Template::class)
                ->setTemplate('Web200_DynamicWidget::add.phtml')
                ->setLabelAddRow($element->getLabelAddRow())
                ->toHtml();
        } catch (LocalizedException $exception) {
            return '';
        }
    }
}

You can add / remove / reorder mulitple select in an Magento 2 widget

```
<?xml version="1.0" encoding="UTF-8"?>
<widgets xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Widget:etc/widget.xsd">
    <widget id="widget_brand" class="Your\Module\Block\Widget\Brand">
        <label>Display Brands</label>
        <description>Display brands</description>
        <parameters>
            <parameter name="title" xsi:type="text" required="true" visible="true" sort_order="10">
                <label>Title</label>
            </parameter>
            <parameter name="brands" xsi:type="block" visible="true" sort_order="20">
                <block class="Web200\DynamicWidget\Block\Adminhtml\Widget\Dynamic">
                    <data>
                        <item name="label" xsi:type="string">City</item>
                        <item name="element" xsi:type="string">Web200\DynamicWidget\Block\Adminhtml\Widget\Select</item>
                        <item name="collection" xsi:type="string">Your\Module\Model\Attribute\Source\Brands</item>
                        <item name="label_add_row" xsi:type="string">Add new brand</item>
                        <item name="label_remove_row" xsi:type="string">Remove brand</item>
                    </data>
                </block>
            </parameter>
        </parameters>
    </widget>
</widgets>
```

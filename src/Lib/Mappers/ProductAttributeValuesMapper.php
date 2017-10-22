<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 10/22/2017
 * Time: 7:36 PM
 */

namespace SphereMall\MS\Lib\Mappers;

class ProductAttributeValuesMapper extends Mapper
{
    #region [Protected methods]
    protected function doCreateObject(array $array)
    {
        $raw = [];
        foreach ($array as $item) {
            $raw[$item['attributeId']]['id'] = $item['attributeId'];
            $raw[$item['attributeId']]['title'] = $item['title'];
            $raw[$item['attributeId']]['code'] = $item['code'];
            $raw[$item['attributeId']]['showInSpecList'] = $item['showInSpecList'];
            $raw[$item['attributeId']]['description'] = $item['description'];
            $raw[$item['attributeId']]['attributeGroupId'] = $item['attributeGroupId'];
            $raw[$item['attributeId']]['cssClass'] = $item['cssClass'];

            $raw[$item['attributeId']]['values'][] = [
                'id'       => $item['id'],
                'value'    => $item['value'],
                'title'    => $item['valueTitle'],
                'cssClass' => $item['valueCssClass'],
            ];
        }

        $mapper = new AttributesMapper();
        $result = [];
        foreach ($raw as $item) {
            $result[] = $mapper->createObject($item);
        }

        return $result;
    }
    #endregion
}
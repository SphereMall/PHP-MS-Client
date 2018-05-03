<?php
/**
 * Created by SergeyBondarchuk.
 * 23.04.2018 17:53
 */

namespace SphereMall\MS\Tests\Resources\StaticTexts;


use SphereMall\MS\Entities\WebText;
use SphereMall\MS\Resources\StaticTexts\WebTextsResource;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class WebTextsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    public function testWebTextsResource()
    {
        $webTexts = $this->client->webTexts();

        $this->assertInstanceOf(WebTextsResource::class, $webTexts);
    }

    public function testWebTextUpdateList()
    {
        /** @var WebText $webText */
        $webText = $this->client->webTexts()->first();
        $data = [
            'keywords'  => [
                [
                    'keyword'     => $webText->keyword,
                    'description' => $webText->description,
                ]
            ],
            'channelId' => $webText->channelId ?? '1',
            'langCode'  => $webText->langCode ? $webText->langCode : 'nl',
        ];
        $res = $this->client->webTexts()->updateList($data);
        $this->assertEquals(count($res), 1);

        foreach ($webText->asArray() as $prop => $value) {
            $this->assertEquals($value, $res[0]->$prop);
        }
    }
    #endregion
}
<?php
/**
 * Created by SergeyBondarchuk.
 * 24.01.2019 15:25
 */

namespace SphereMall\MS\Tests\Resources\Products;


use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class DocumentsResourceTest extends SetUpResourceTest
{


    public function testDocumentDetail()
    {
        $documents = $this->client
            ->documents()
            ->limit(1)
            ->detailAll();

        $this->assertCount(1, $documents);

        $this->assertNotNull($documents[0]->attributes);
        $this->assertNotNull($documents[0]->media);
        $this->assertNotNull($documents[0]->functionalName);
    }
}
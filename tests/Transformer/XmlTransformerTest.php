<?php

declare(strict_types=1);

namespace Chubbyphp\Tests\Deserialization\Transformer;

use Chubbyphp\Deserialization\Transformer\TransformerException;
use Chubbyphp\Deserialization\Transformer\XmlTransformer;

/**
 * @covers \Chubbyphp\Deserialization\Transformer\XmlTransformer
 */
class XmlTransformerTest extends AbstractTransformerTest
{
    public function testContentType()
    {
        $transformer = new XmlTransformer();

        self::assertSame('application/xml', $transformer->getContentType());
    }

    /**
     * @dataProvider dataProvider
     *
     * @param array $expectedData
     */
    public function testTransform(array $expectedData)
    {
        $transformer = new XmlTransformer();

        $xml = <<<EOD
<?xml version="1.0" encoding="UTF-8"?>
<meta-type value="search">
  <page type="integer">1</page>
  <perPage type="integer">10</perPage>
  <search></search>
  <sort type="string">name</sort>
  <order type="string">asc</order>
  <meta-embedded>
    <mainItem>
      <meta-type value="item">
        <id type="string">id1</id>
        <name type="string">A fancy Name</name>
        <treeValues>
          <treeValue key="1">
            <treeValue type="integer" key="2">3</treeValue>
          </treeValue>
        </treeValues>
        <progress type="float">76.8</progress>
        <active type="boolean">true</active>
        <meta-links>
          <read>
            <href type="string">http://test.com/items/id1</href>
            <method type="string">GET</method>
          </read>
          <update>
            <href type="string">http://test.com/items/id1</href>
            <method type="string">PUT</method>
          </update>
          <delete>
            <href type="string">http://test.com/items/id1</href>
            <method type="string">DELETE</method>
          </delete>
        </meta-links>
      </meta-type>
    </mainItem>
    <items>
      <meta-type value="item" key="0">
        <id type="string">id1</id>
        <name type="string">A fancy Name</name>
        <treeValues>
          <treeValue key="1">
            <treeValue type="integer" key="2">3</treeValue>
          </treeValue>
        </treeValues>
        <progress type="float">76.8</progress>
        <active type="boolean">true</active>
        <meta-links>
          <read>
            <href type="string">http://test.com/items/id1</href>
            <method type="string">GET</method>
          </read>
          <update>
            <href type="string">http://test.com/items/id1</href>
            <method type="string">PUT</method>
          </update>
          <delete>
            <href type="string">http://test.com/items/id1</href>
            <method type="string">DELETE</method>
          </delete>
        </meta-links>
      </meta-type>
      <meta-type value="item" key="1">
        <id type="string">id2</id>
        <name type="string">B fancy Name</name>
        <treeValues>
          <treeValue key="1">
            <treeValue type="integer" key="2">3</treeValue>
            <treeValue type="integer" key="3">4</treeValue>
          </treeValue>
        </treeValues>
        <progress type="float">24.7</progress>
        <active type="boolean">true</active>
        <meta-links>
          <read>
            <href type="string">http://test.com/items/id2</href>
            <method type="string">GET</method>
          </read>
          <update>
            <href type="string">http://test.com/items/id2</href>
            <method type="string">PUT</method>
          </update>
          <delete>
            <href type="string">http://test.com/items/id2</href>
            <method type="string">DELETE</method>
          </delete>
        </meta-links>
      </meta-type>
      <meta-type value="item" key="2">
        <id type="string">id3</id>
        <name type="string">C fancy Name</name>
        <treeValues>
          <treeValue key="1">
            <treeValue type="integer" key="2">3</treeValue>
            <treeValue type="integer" key="3">4</treeValue>
            <treeValue type="integer" key="6">7</treeValue>
          </treeValue>
        </treeValues>
        <progress type="float">100</progress>
        <active type="boolean">false</active>
        <meta-links>
          <read>
            <href type="string">http://test.com/items/id3</href>
            <method type="string">GET</method>
          </read>
          <update>
            <href type="string">http://test.com/items/id3</href>
            <method type="string">PUT</method>
          </update>
          <delete>
            <href type="string">http://test.com/items/id3</href>
            <method type="string">DELETE</method>
          </delete>
        </meta-links>
      </meta-type>
    </items>
  </meta-embedded>
  <meta-links>
    <self>
      <href type="string"><![CDATA[http://test.com/items/?page=1&perPage=10&sort=name&order=asc]]></href>
      <method type="string">GET</method>
    </self>
    <create>
      <href type="string">http://test.com/items/</href>
      <method type="string">POST</method>
    </create>
  </meta-links>
</meta-type>
EOD;

        $data = $transformer->transform($xml);

        self::assertEquals($expectedData, $data);
    }

    public function testInvalidTransform()
    {
        self::expectException(TransformerException::class);
        self::expectExceptionMessage('Transform error: Xml not parsable');

        $transformer = new XmlTransformer();
        $transformer->transform('====');
    }
}

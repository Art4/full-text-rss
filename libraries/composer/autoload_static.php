<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87
{
    public static $files = array (
        'e8b9612bd57a56c6db24fda32a44eac2' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie.php',
    );

    public static $prefixLengthsPsr4 = array (
        'f' => 
        array (
            'fivefilters\\Readability\\' => 24,
        ),
        'S' => 
        array (
            'SimplePie\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
        ),
        'M' => 
        array (
            'Masterminds\\' => 12,
        ),
        'L' => 
        array (
            'League\\Uri\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'fivefilters\\Readability\\' => 
        array (
            0 => __DIR__ . '/..' . '/fivefilters/readability.php/src',
        ),
        'SimplePie\\' => 
        array (
            0 => __DIR__ . '/..' . '/simplepie/simplepie/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Masterminds\\' => 
        array (
            0 => __DIR__ . '/..' . '/masterminds/html5/src',
        ),
        'League\\Uri\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/uri/src',
            1 => __DIR__ . '/..' . '/league/uri-interfaces/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SimplePie' => 
            array (
                0 => __DIR__ . '/..' . '/simplepie/simplepie/library',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'League\\Uri\\Contracts\\AuthorityInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/AuthorityInterface.php',
        'League\\Uri\\Contracts\\DataPathInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/DataPathInterface.php',
        'League\\Uri\\Contracts\\DomainHostInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/DomainHostInterface.php',
        'League\\Uri\\Contracts\\FragmentInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/FragmentInterface.php',
        'League\\Uri\\Contracts\\HostInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/HostInterface.php',
        'League\\Uri\\Contracts\\IpHostInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/IpHostInterface.php',
        'League\\Uri\\Contracts\\PathInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/PathInterface.php',
        'League\\Uri\\Contracts\\PortInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/PortInterface.php',
        'League\\Uri\\Contracts\\QueryInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/QueryInterface.php',
        'League\\Uri\\Contracts\\SegmentedPathInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/SegmentedPathInterface.php',
        'League\\Uri\\Contracts\\UriComponentInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/UriComponentInterface.php',
        'League\\Uri\\Contracts\\UriException' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/UriException.php',
        'League\\Uri\\Contracts\\UriInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/UriInterface.php',
        'League\\Uri\\Contracts\\UserInfoInterface' => __DIR__ . '/..' . '/league/uri-interfaces/src/Contracts/UserInfoInterface.php',
        'League\\Uri\\Exceptions\\FileinfoSupportMissing' => __DIR__ . '/..' . '/league/uri-interfaces/src/Exceptions/FileinfoSupportMissing.php',
        'League\\Uri\\Exceptions\\IdnSupportMissing' => __DIR__ . '/..' . '/league/uri-interfaces/src/Exceptions/IdnSupportMissing.php',
        'League\\Uri\\Exceptions\\IdnaConversionFailed' => __DIR__ . '/..' . '/league/uri-interfaces/src/Exceptions/IdnaConversionFailed.php',
        'League\\Uri\\Exceptions\\SyntaxError' => __DIR__ . '/..' . '/league/uri-interfaces/src/Exceptions/SyntaxError.php',
        'League\\Uri\\Exceptions\\TemplateCanNotBeExpanded' => __DIR__ . '/..' . '/league/uri/src/Exceptions/TemplateCanNotBeExpanded.php',
        'League\\Uri\\Http' => __DIR__ . '/..' . '/league/uri/src/Http.php',
        'League\\Uri\\HttpFactory' => __DIR__ . '/..' . '/league/uri/src/HttpFactory.php',
        'League\\Uri\\Idna\\Idna' => __DIR__ . '/..' . '/league/uri-interfaces/src/Idna/Idna.php',
        'League\\Uri\\Idna\\IdnaInfo' => __DIR__ . '/..' . '/league/uri-interfaces/src/Idna/IdnaInfo.php',
        'League\\Uri\\Uri' => __DIR__ . '/..' . '/league/uri/src/Uri.php',
        'League\\Uri\\UriInfo' => __DIR__ . '/..' . '/league/uri/src/UriInfo.php',
        'League\\Uri\\UriResolver' => __DIR__ . '/..' . '/league/uri/src/UriResolver.php',
        'League\\Uri\\UriString' => __DIR__ . '/..' . '/league/uri/src/UriString.php',
        'League\\Uri\\UriTemplate' => __DIR__ . '/..' . '/league/uri/src/UriTemplate.php',
        'League\\Uri\\UriTemplate\\Expression' => __DIR__ . '/..' . '/league/uri/src/UriTemplate/Expression.php',
        'League\\Uri\\UriTemplate\\Template' => __DIR__ . '/..' . '/league/uri/src/UriTemplate/Template.php',
        'League\\Uri\\UriTemplate\\VarSpecifier' => __DIR__ . '/..' . '/league/uri/src/UriTemplate/VarSpecifier.php',
        'League\\Uri\\UriTemplate\\VariableBag' => __DIR__ . '/..' . '/league/uri/src/UriTemplate/VariableBag.php',
        'Masterminds\\HTML5' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5.php',
        'Masterminds\\HTML5\\Elements' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Elements.php',
        'Masterminds\\HTML5\\Entities' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Entities.php',
        'Masterminds\\HTML5\\Exception' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Exception.php',
        'Masterminds\\HTML5\\InstructionProcessor' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/InstructionProcessor.php',
        'Masterminds\\HTML5\\Parser\\CharacterReference' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/CharacterReference.php',
        'Masterminds\\HTML5\\Parser\\DOMTreeBuilder' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/DOMTreeBuilder.php',
        'Masterminds\\HTML5\\Parser\\EventHandler' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/EventHandler.php',
        'Masterminds\\HTML5\\Parser\\FileInputStream' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/FileInputStream.php',
        'Masterminds\\HTML5\\Parser\\InputStream' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/InputStream.php',
        'Masterminds\\HTML5\\Parser\\ParseError' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/ParseError.php',
        'Masterminds\\HTML5\\Parser\\Scanner' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/Scanner.php',
        'Masterminds\\HTML5\\Parser\\StringInputStream' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/StringInputStream.php',
        'Masterminds\\HTML5\\Parser\\Tokenizer' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/Tokenizer.php',
        'Masterminds\\HTML5\\Parser\\TreeBuildingRules' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/TreeBuildingRules.php',
        'Masterminds\\HTML5\\Parser\\UTF8Utils' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Parser/UTF8Utils.php',
        'Masterminds\\HTML5\\Serializer\\HTML5Entities' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Serializer/HTML5Entities.php',
        'Masterminds\\HTML5\\Serializer\\OutputRules' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Serializer/OutputRules.php',
        'Masterminds\\HTML5\\Serializer\\RulesInterface' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Serializer/RulesInterface.php',
        'Masterminds\\HTML5\\Serializer\\Traverser' => __DIR__ . '/..' . '/masterminds/html5/src/HTML5/Serializer/Traverser.php',
        'Psr\\Http\\Message\\MessageInterface' => __DIR__ . '/..' . '/psr/http-message/src/MessageInterface.php',
        'Psr\\Http\\Message\\RequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/RequestInterface.php',
        'Psr\\Http\\Message\\ResponseInterface' => __DIR__ . '/..' . '/psr/http-message/src/ResponseInterface.php',
        'Psr\\Http\\Message\\ServerRequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/ServerRequestInterface.php',
        'Psr\\Http\\Message\\StreamInterface' => __DIR__ . '/..' . '/psr/http-message/src/StreamInterface.php',
        'Psr\\Http\\Message\\UploadedFileInterface' => __DIR__ . '/..' . '/psr/http-message/src/UploadedFileInterface.php',
        'Psr\\Http\\Message\\UriInterface' => __DIR__ . '/..' . '/psr/http-message/src/UriInterface.php',
        'Psr\\Log\\AbstractLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/AbstractLogger.php',
        'Psr\\Log\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/log/Psr/Log/InvalidArgumentException.php',
        'Psr\\Log\\LogLevel' => __DIR__ . '/..' . '/psr/log/Psr/Log/LogLevel.php',
        'Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareInterface.php',
        'Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareTrait.php',
        'Psr\\Log\\LoggerInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerInterface.php',
        'Psr\\Log\\LoggerTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerTrait.php',
        'Psr\\Log\\NullLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/NullLogger.php',
        'SimplePie' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie.php',
        'SimplePie\\Author' => __DIR__ . '/..' . '/simplepie/simplepie/src/Author.php',
        'SimplePie\\Cache' => __DIR__ . '/..' . '/simplepie/simplepie/src/Cache.php',
        'SimplePie\\Cache\\Base' => __DIR__ . '/..' . '/simplepie/simplepie/src/Cache/Base.php',
        'SimplePie\\Cache\\DB' => __DIR__ . '/..' . '/simplepie/simplepie/src/Cache/DB.php',
        'SimplePie\\Cache\\File' => __DIR__ . '/..' . '/simplepie/simplepie/src/Cache/File.php',
        'SimplePie\\Cache\\Memcache' => __DIR__ . '/..' . '/simplepie/simplepie/src/Cache/Memcache.php',
        'SimplePie\\Cache\\Memcached' => __DIR__ . '/..' . '/simplepie/simplepie/src/Cache/Memcached.php',
        'SimplePie\\Cache\\MySQL' => __DIR__ . '/..' . '/simplepie/simplepie/src/Cache/MySQL.php',
        'SimplePie\\Cache\\Redis' => __DIR__ . '/..' . '/simplepie/simplepie/src/Cache/Redis.php',
        'SimplePie\\Caption' => __DIR__ . '/..' . '/simplepie/simplepie/src/Caption.php',
        'SimplePie\\Category' => __DIR__ . '/..' . '/simplepie/simplepie/src/Category.php',
        'SimplePie\\Content\\Type\\Sniffer' => __DIR__ . '/..' . '/simplepie/simplepie/src/Content/Type/Sniffer.php',
        'SimplePie\\Copyright' => __DIR__ . '/..' . '/simplepie/simplepie/src/Copyright.php',
        'SimplePie\\Credit' => __DIR__ . '/..' . '/simplepie/simplepie/src/Credit.php',
        'SimplePie\\Enclosure' => __DIR__ . '/..' . '/simplepie/simplepie/src/Enclosure.php',
        'SimplePie\\Exception' => __DIR__ . '/..' . '/simplepie/simplepie/src/Exception.php',
        'SimplePie\\File' => __DIR__ . '/..' . '/simplepie/simplepie/src/File.php',
        'SimplePie\\Gzdecode' => __DIR__ . '/..' . '/simplepie/simplepie/src/Gzdecode.php',
        'SimplePie\\HTTP\\Parser' => __DIR__ . '/..' . '/simplepie/simplepie/src/HTTP/Parser.php',
        'SimplePie\\IRI' => __DIR__ . '/..' . '/simplepie/simplepie/src/IRI.php',
        'SimplePie\\Item' => __DIR__ . '/..' . '/simplepie/simplepie/src/Item.php',
        'SimplePie\\Locator' => __DIR__ . '/..' . '/simplepie/simplepie/src/Locator.php',
        'SimplePie\\Misc' => __DIR__ . '/..' . '/simplepie/simplepie/src/Misc.php',
        'SimplePie\\Net\\IPv6' => __DIR__ . '/..' . '/simplepie/simplepie/src/Net/IPv6.php',
        'SimplePie\\Parse\\Date' => __DIR__ . '/..' . '/simplepie/simplepie/src/Parse/Date.php',
        'SimplePie\\Parser' => __DIR__ . '/..' . '/simplepie/simplepie/src/Parser.php',
        'SimplePie\\Rating' => __DIR__ . '/..' . '/simplepie/simplepie/src/Rating.php',
        'SimplePie\\Registry' => __DIR__ . '/..' . '/simplepie/simplepie/src/Registry.php',
        'SimplePie\\Restriction' => __DIR__ . '/..' . '/simplepie/simplepie/src/Restriction.php',
        'SimplePie\\Sanitize' => __DIR__ . '/..' . '/simplepie/simplepie/src/Sanitize.php',
        'SimplePie\\SimplePie' => __DIR__ . '/..' . '/simplepie/simplepie/src/SimplePie.php',
        'SimplePie\\Source' => __DIR__ . '/..' . '/simplepie/simplepie/src/Source.php',
        'SimplePie\\XML\\Declaration\\Parser' => __DIR__ . '/..' . '/simplepie/simplepie/src/XML/Declaration/Parser.php',
        'SimplePie_Author' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Author.php',
        'SimplePie_Cache' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Cache.php',
        'SimplePie_Cache_Base' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Cache/Base.php',
        'SimplePie_Cache_DB' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Cache/DB.php',
        'SimplePie_Cache_File' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Cache/File.php',
        'SimplePie_Cache_Memcache' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Cache/Memcache.php',
        'SimplePie_Cache_Memcached' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Cache/Memcached.php',
        'SimplePie_Cache_MySQL' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Cache/MySQL.php',
        'SimplePie_Cache_Redis' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Cache/Redis.php',
        'SimplePie_Caption' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Caption.php',
        'SimplePie_Category' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Category.php',
        'SimplePie_Content_Type_Sniffer' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Content/Type/Sniffer.php',
        'SimplePie_Copyright' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Copyright.php',
        'SimplePie_Core' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Core.php',
        'SimplePie_Credit' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Credit.php',
        'SimplePie_Decode_HTML_Entities' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Decode/HTML/Entities.php',
        'SimplePie_Enclosure' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Enclosure.php',
        'SimplePie_Exception' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Exception.php',
        'SimplePie_File' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/File.php',
        'SimplePie_HTTP_Parser' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/HTTP/Parser.php',
        'SimplePie_IRI' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/IRI.php',
        'SimplePie_Item' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Item.php',
        'SimplePie_Locator' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Locator.php',
        'SimplePie_Misc' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Misc.php',
        'SimplePie_Net_IPv6' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Net/IPv6.php',
        'SimplePie_Parse_Date' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Parse/Date.php',
        'SimplePie_Parser' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Parser.php',
        'SimplePie_Rating' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Rating.php',
        'SimplePie_Registry' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Registry.php',
        'SimplePie_Restriction' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Restriction.php',
        'SimplePie_Sanitize' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Sanitize.php',
        'SimplePie_Source' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/Source.php',
        'SimplePie_XML_Declaration_Parser' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/XML/Declaration/Parser.php',
        'SimplePie_gzdecode' => __DIR__ . '/..' . '/simplepie/simplepie/library/SimplePie/gzdecode.php',
        'fivefilters\\Readability\\Configuration' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Configuration.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMAttr' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMAttr.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMCdataSection' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMCdataSection.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMCharacterData' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMCharacterData.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMComment' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMComment.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMDocument' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMDocument.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMDocumentFragment' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMDocumentFragment.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMDocumentType' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMDocumentType.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMElement' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMElement.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMEntity' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMEntity.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMEntityReference' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMEntityReference.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMNode' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMNode.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMNodeList' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMNodeList.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMNotation' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMNotation.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMProcessingInstruction' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMProcessingInstruction.php',
        'fivefilters\\Readability\\Nodes\\DOM\\DOMText' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/DOM/DOMText.php',
        'fivefilters\\Readability\\Nodes\\NodeTrait' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/NodeTrait.php',
        'fivefilters\\Readability\\Nodes\\NodeUtility' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Nodes/NodeUtility.php',
        'fivefilters\\Readability\\ParseException' => __DIR__ . '/..' . '/fivefilters/readability.php/src/ParseException.php',
        'fivefilters\\Readability\\Readability' => __DIR__ . '/..' . '/fivefilters/readability.php/src/Readability.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87::$classMap;

        }, null, ClassLoader::class);
    }
}

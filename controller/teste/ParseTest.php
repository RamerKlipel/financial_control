<?php

namespace Controllers\teste;

use PhpParser\Error;
use PhpParser\NodeFinder;
use PhpParser\ParserFactory;

class ParseTest
{
    protected object $parser;
    protected object $nodeFinder;
    public function __construct()
    {
        // callViewFrom('emptyindex');
        $this->parser = (new ParserFactory())->createForHostVersion();
        $this->nodeFinder = new NodeFinder();
        $this->testFile();
    }

    public function testFile()
    {
        $file = (file_get_contents("./controller/bills.php"));
        $ast = $this->parser->parse($file);

        $result = [
            'namespace' => null,
            'class' => null,
            'extends' => null,
            'traits' => [],
            'methods' => [],
            'uses' => [],
        ];

        $objNamespace = $this->nodeFinder->findFirstInstanceOf(
            $ast,
            'PhpParser\Node\Name'
        );

        if ($objNamespace) {
            $result['namespace'] = $objNamespace->name;
        }

        $arrObjUses = $this->nodeFinder->findInstanceOf(
            $ast,
            "PhpParser\Node\UseItem"
        );

        foreach ($arrObjUses as $objUses) {
            $result["uses"][] = ($objUses->uses[0]->name->name ?? null);
        }

        $arrObjClass = $this->nodeFinder->findInstanceOf(
            $ast,
            "PhpParser\Node\Stmt\Class_"
        );

        if ($arrObjClass) {
            $objClassIndentifier = $this->nodeFinder->findFirstInstanceOf($arrObjClass, "PhpParser\Node\Identifier");

            if ($objClassIndentifier) {
                $result["class"] = $objClassIndentifier->name;
            }

            if ($arrObjClass[0]->extends ?? null) {
                $result["extends"] = $arrObjClass[0]->extends->name;
            }

            foreach($arrObjClass[0] as $objClass) {
                printr($objClass);
            }
die;
            printr($ast); die;
        }

        /**
         * Classe
         */
        $class = $this->nodeFinder->findFirstInstanceOf(
            $ast,
            Node\Stmt\Class_::class
        );

        if ($class) {

            $result['class'] = $class->name?->toString();

            if ($class->extends) {
                $result['extends'] = $class->extends->toString();
            }

            /**
             * Traits
             */
            foreach ($class->stmts as $stmt) {

                if ($stmt instanceof Node\Stmt\TraitUse) {

                    foreach ($stmt->traits as $trait) {
                        $result['traits'][] = $trait->toString();
                    }
                }

                /**
                 * Métodos
                 */
                if ($stmt instanceof Node\Stmt\ClassMethod) {

                    $result['methods'][] = [
                        'name' => $stmt->name->toString(),
                        'visibility' =>
                        $stmt->isPublic() ? 'public' : ($stmt->isProtected() ? 'protected' : 'private'),
                        'static' => $stmt->isStatic(),
                        'returnType' => $stmt->returnType?->toString()
                    ];
                }
            }
        }

        printr($result);die;
        die;
    }
}

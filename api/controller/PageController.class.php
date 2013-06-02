<?php

include_once('AbstractPdoController.class.php');

class PageController extends AbstractPdoController {

    public function __construct($config) {
        parent::__construct($config);


    }

    public function getAction() {
        try {
            $sqlQuery = '
                SELECT
                  page.id,
                  page_type.name AS typeName,
                  page.parentId,
                  page_content.id AS pageContentId,
                  language.tag AS languageTag,
                  page_content.previousVersionId,
                  page_content.version,
                  page_content.published,
                  page_content.title,
                  page_content.titleClean,
                  page_content.tags,
                  page_content.description,
                  page_content.content,
                  page_content.isFamilyFriendly,
                  page_content.wordcount,
                  page_content.datetimeCreated,
                  page_content.datetimeModified,
                  page_content.datetimePublished
                FROM page
                LEFT OUTER JOIN page_type
                ON page.typeId = page_type.id
                LEFT OUTER JOIN page_content
                ON page.id = page_content.pageId
                LEFT OUTER JOIN language
                ON page_content.languageId = language.id
            ';
            $statement = $this->pdo->prepare($sqlQuery);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return array('error' => $e->getMessage());
        }
    }

    public function postAction() {
        return array('result' => true);
    }

    public function putAction() {
        return array('result' => true);
    }

    public function deleteAction() {
        return array('result' => true);
    }
}


?>

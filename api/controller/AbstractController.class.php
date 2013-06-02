<?php

abstract class AbstractController {
    abstract protected function getAction();

    abstract protected function postAction();

    abstract protected function putAction();

    abstract protected function deleteAction();
}


?>

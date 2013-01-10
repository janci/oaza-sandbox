<?php
interface ITemplateBuilder
{
    public function buildBegin($command,$parameters=null);
    public function buildEnd($command);

}

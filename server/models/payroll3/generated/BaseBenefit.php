<?php

/**
 * BaseBenefit
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property decimal $damt
 * @property string $descr
 * @property integer $perc
 * @property integer $deduct
 * @property integer $taxable
 * @property integer $active
 * @property Doctrine_Collection $PayBenefit
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6401 2009-09-24 16:12:04Z guilhermeblanco $
 */
abstract class BaseBenefit extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('benefit');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'unsigned' => 0,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
             'fixed' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('damt', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'unsigned' => 0,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'scale' => false,
             ));
        $this->hasColumn('descr', 'string', null, array(
             'type' => 'string',
             'fixed' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('perc', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'unsigned' => 0,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('deduct', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'unsigned' => 0,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('taxable', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'unsigned' => 0,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('active', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'unsigned' => 0,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasMany('PayBenefit', array(
             'local' => 'id',
             'foreign' => 'benefit'));
    }
}
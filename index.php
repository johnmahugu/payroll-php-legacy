<?php
session_start();

require_once('server/bootstrap.php');
require_once('server/application/Request.php');
require_once('server/application/Dispatcher.php');
require_once('server/controllers/RoleController.php');
require_once('server/controllers/DeptController.php');
require_once('server/controllers/UserController.php');
require_once('server/controllers/EmployeeController.php');
require_once('server/controllers/PostController.php');
require_once('server/controllers/LoginController.php');
//require_once('server/controllers/NhifController.php');
require_once('server/controllers/PayeController.php');
require_once('server/controllers/TaxReliefController.php');
require_once('server/controllers/PayrollController.php');
require_once('server/controllers/BenefitController.php');
require_once('server/controllers/PeriodController.php');
require_once('server/controllers/Controller.php');
require_once('server/dao/DaoFactory.php');
require_once('server/dao/PeriodDao.php');
require_once('server/dao/PayrollDao.php');
require_once('server/dao/RoleDao.php');
require_once('server/dao/DeptDao.php');
require_once('server/dao/UserDao.php');
//require_once('server/dao/MenuDao.php');
require_once('server/dao/PostDao.php');
require_once('server/dao/EmployeeDao.php');
//require_once('server/dao/NhifDao.php');
require_once('server/dao/PayeDao.php');
require_once('server/dao/TaxReliefDao.php');
require_once('server/dao/BenefitDao.php');
require_once('server/dto/AbstractDto.php');
require_once('server/dto/PayrollDto.php');
require_once('server/dto/RoleDto.php');
require_once('server/dto/DeptDto.php');
require_once('server/dto/UserDto.php');
require_once('server/dto/PostDto.php');
require_once('server/dto/LoginDto.php');
require_once('server/dto/PeriodDto.php');
require_once('server/dto/BenefitDto.php');
require_once('server/dto/EmployeeDto.php');
//require_once('server/dto/NhifDto.php');
require_once('server/dto/TaxReliefDto.php');
require_once('server/dto/PayeDto.php');
require_once('server/util/Tokenizer.php');


//exit(Request::isEmpty());

if(Request::isEmpty())
	Request::dispatch("client/index.html");

new Dispatcher(Request::getName());
?>
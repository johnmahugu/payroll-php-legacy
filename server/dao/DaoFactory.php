<?php

class DaoFactory{

	private static $daoFactory = null;
	private $roleDao;
	private $userDao;
	private $postDao;
	private $deptDao;
	private $employeeDao;
	private $payeDao;
	private $nhifDao;
	private $taxReliefDao;
	private $periodDao;
	
	
	//Ensure Single Instance of Factory and DAOs
	static function getInstance(){
	
		if(is_null(self::$daoFactory))
			self::$daoFactory = new DaoFactory();
			
		return self::$daoFactory;
	}
	
	function getRoleDao(){
	
		if(is_null($this->roleDao))
			$this->roleDao = new RoleDao();
			
		return $this->roleDao;	
	}
	
	function getUserDao(){
	
		if(is_null($this->userDao))
			$this->userDao = new UserDao();
			
		return $this->userDao;	
	}
	
	function getPostDao(){
	
		if(is_null($this->postDao))
			$this->postDao = new PostDao();
			
		return $this->postDao;	
	}
	
	function getDeptDao(){
	
		if(is_null($this->deptDao))
			$this->deptDao = new DeptDao();
			
		return $this->deptDao;	
	}
	
	function getEmployeeDao(){
	
		if(is_null($this->employeeDao))
			$this->employeeDao = new EmployeeDao();
			
		return $this->employeeDao;	
	}
	
	function getPayeDao(){
	
		if(is_null($this->payeDao))
			$this->payeDao = new PayeDao();
			
		return $this->payeDao;	
	}
	
	function getNhifDao(){
	
		if(is_null($this->nhifDao))
			$this->nhifDao = new NhifDao();
			
		return $this->nhifDao;	
	}
	
	function getTaxReliefDao(){
	
		if(is_null($this->taxReliefDao))
			$this->taxReliefDao = new TaxReliefDao();
			
		return $this->taxReliefDao;	
	}
	
	function getBenefitDao(){
	
		if(is_null($this->benefitDao))
			$this->benefitDao = new BenefitDao();
			
		return $this->benefitDao;	
	}
	
	function getPayrollDao(){
	
		if(is_null($this->payrollDao))
			$this->payrollDao = new PayrollDao();
			
		return $this->payrollDao;	
	}
	
	function getPeriodDao(){
	
		if(is_null($this->periodDao))
			$this->periodDao = new PeriodDao();
			
		return $this->periodDao;	
	}
}
?>
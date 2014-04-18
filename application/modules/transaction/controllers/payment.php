<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment extends MX_Controller{
	public function index($page=1){
		if($this->session->userData('userTypeID')==2)
		{
			$this->load->model("transaction");
			$this->load->model("payments");
			$data['transactions']=$this->transaction->getTransactions($this->session->userdata('userID'),$page);
			$data['total_records']=$this->transaction->getTransactionsCount($this->session->userdata('userID'));
			$data['paymentDetails']=$this->payments->getPaymentDetails($this->session->userdata('userID'));
			$this->layout->setLayout("layout/main");
			$this->layout->view('dashboard',$data);
		}
		elseif($this->session->userData('userTypeID')==1)
		{
			$this->load->model("transaction");
			$this->load->model("payments");
			$data['transactions']=$this->transaction->getTransactions($this->session->userdata('userID'),$page);
			$data['total_records']=$this->transaction->getTransactionsCount($this->session->userdata('userID'));
			$data['paymentDetails']=$this->payments->getPaymentDetails($this->session->userdata('userID'));
			$this->layout->setLayout("layout/main");
			$this->layout->view('dashboard',$data);
		}
		else
		{
			$this->load->model("transaction");
			$this->load->model("payments");
			$data['transactions']=$this->transaction->getTransactions($this->session->userdata('userID'),$page);
			$data['total_records']=$this->transaction->getTransactionsCount($this->session->userdata('userID'));
			$data['paymentDetails']=$this->payments->getPaymentDetails($this->session->userdata('userID'));
			$this->layout->setLayout("layout/main");
			$this->layout->view('dashboard',$data);
		}
	}
	public function advertiser($page=1){
		$this->load->model("transaction");
			$this->load->model("payments");
			$data['transactions']=$this->transaction->getTransactionsAdvertiser($this->session->userdata('userID'),$page);
			$data['total_records']=$this->transaction->getTransactionsAdvertiserCount($this->session->userdata('userID'));
			$data['paymentDetails']=$this->payments->getPaymentDetails($this->session->userdata('userID'));
			$this->layout->setLayout("layout/main");
			$this->layout->view('dashboard',$data);
	}
	public function add(){
		if($this->session->userData('userTypeID')==2)
		{
			$this->load->model("payments");
			$data['paymentDetails']=$this->payments->getPaymentDetails($this->session->userData('userID'));
			$this->layout->setLayout("layout/main");
			$this->layout->view('payment_add',$data);
			if($this->input->post())
			{
				$this->load->model("transaction");
				if($this->input->post('amount')){
					$tranData = array(
						"amount" => $this->input->post('amount'),
						"payerID" => $this->session->userdata('userID'),
						"payeeID" => "3",
						"status" =>"Pending",
						"createdBy" =>$this->session->userdata('userID'),
						"createdDate" =>date('Y-m-d H:i:s'),
					);
					$tran_id=$this->transaction->add($tranData);
					
					if($tran_id>0){
						$paymentData = array(
						"userID" => $this->session->userdata('userID'),
						"balanceAmount" => $this->input->post('amount'),
						"createdBy" =>$this->session->userdata('userID'),
						"createdDate" =>date('Y-m-d H:i:s'),
						);
						echo $this->payments->add($paymentData);
					}
				}
				else
				{
					$tranData = array(
						"amount" => $this->input->post('paidAmount'),
						"payerID" => $this->session->userdata('userID'),
						"payeeID" => "3",
						"status" =>"Pending",
						"createdBy" =>$this->session->userdata('userID'),
						"createdDate" =>date('Y-m-d H:i:s'),
					);
					$tran_id=$this->transaction->add($tranData);
				
					if($tran_id>0){
						//$billable=$this->payments->getBillableAmount($this->session->userdata('userID'));
						$balance=$this->payments->getBalanceAmount($this->session->userdata('userID'));
						if(isset($balance[0]['balanceAmount'])){
							$balamount=$balance[0]['balanceAmount']+$this->input->post('paidAmount');
						}
						else
						{
							$balamount=$this->input->post('paidAmount');
						}

						$paymentData = array(
						"balanceAmount" => $balamount,
						"updatedBy" =>$this->session->userdata('userID'),
						"updatedDate" =>date('Y-m-d H:i:s'),
						);
						echo $this->payments->updateBalance($paymentData,$this->session->userdata('userID'));
						
					}
					
				}
			}
		}
		elseif($this->session->userData('userTypeID')==1)
		{
			
			if($this->input->post())
			{
				$this->load->model("payments");
				$data['paymentDetails']=$this->payments->getPaymentDetails($this->input->post('publisherID'));
				$this->load->model("transaction");
				$tranData = array(
						"amount" => $this->input->post('payingAamount'),
						"payerID" => $this->session->userdata('userID'),
						"payeeID" =>$this->input->post('publisherID'),
						"status" =>"Done",
						"createdBy" =>$this->session->userdata('userID'),
						"createdDate" =>date('Y-m-d H:i:s'),
					);
					$tran_id=$this->transaction->add($tranData);
					if($tran_id>0){
						if(isset($data['paymentDetails'][0]['userID'])){
							$amt=$data['paymentDetails'][0]['paidAmount']+$this->input->post('payingAamount');
							if($this->input->post('publisherAmount')>$amt)
							{
								$balance=$this->input->post('publisherAmount')-$amt;
							}
							else
							{
								$balance=0;
							}
							$paymentData = array(
							"paidAmount" => $amt,
							"billableAmount"=>$this->input->post('publisherAmount'),
							"balanceAmount" => $balance,
							"updatedBy" =>$this->session->userdata('userID'),
							"updatedDate" =>date('Y-m-d H:i:s'),
							);
							echo $this->payments->updateBalance($paymentData,$this->input->post('publisherID'));;
						}
						else
						{
							$amt=$this->input->post('payingAamount');
							if($this->input->post('publisherAmount')>$amt)
							{
								$balance=$this->input->post('publisherAmount')-$amt;
							}
							else
							{
								$balance=0;
							}
							$paymentData = array(
							"userID"=>$this->input->post('publisherID'),
							"paidAmount" => $amt,
							"billableAmount"=>$this->input->post('publisherAmount'),
							"balanceAmount" => $balance,
							"createdBy" =>$this->session->userdata('userID'),
							"createdDate" =>date('Y-m-d H:i:s'),
							);
							echo $this->payments->add($paymentData);
						}
					}
			}
			else
			{
				$this->load->model("user");
				$data['publishers']=$this->user->getAllPublishers();
				$this->layout->setLayout("layout/main");
				$this->layout->view('make_payment',$data);
			}
			
		}
		/*$this->load->model("url");
		//$this->load->model("Clicksdetail");
		$data['linkUrls']=$this->url->getPublishedAdvertiserUrls($this->session->userData('userID'));
		if($this->input->post())
		{
			if($this->session->userData('userTypeID')==2)
			{
				$this->load->model("transaction");
				$tranData = array(
					"linkID" => $this->input->post('linkID')
					
				);
				if($this->transaction->isExist($tranData))
				{
						echo "0";
				}
				else
				{
					$tranData = array(
						"linkID" => $this->input->post('linkID'),
						"amount" => $this->input->post('amount'),
						"payerID" => $this->session->userdata('userID'),
						"payeeID" => "0",
						"status" =>"Pending",
						"createdBy" =>$this->session->userdata('userID'),
					);
					echo $this->transaction->add($tranData);
				}

				

			}
		}
		else
		{
			$this->layout->setLayout("layout/main");
			$this->layout->view('payment_add',$data);
		}
		*/
	}
	public function getPublisherPaymentDetails($uid=0){
		$this->load->model('clicksdetail');
		$this->load->model('payments');
		$data['pubAmount']=$this->clicksdetail->getPublisherTotalAmount($uid);
		
		$data['paidAmount']=$this->payments->getPublisherPaidAmount($uid);
		//print_r($data['paidAmount'][0]['paidAmount']);
		//exit;
		if(isset($data['pubAmount'][0]['publisherPayment']) && !isset($data['paidAmount'][0]['paidAmount'])){
			$data['due']=$data['pubAmount'][0]['publisherPayment'];
			
		}
		elseif(!isset($data['pubAmount'][0]['publisherPayment']) && isset($data['paidAmount'][0]['paidAmount']))
		{
			$data['due']="0";
		}
		elseif(isset($data['pubAmount'][0]['publisherPayment']) && isset($data['paidAmount'][0]['paidAmount'])){
			$data['due']=$data['pubAmount'][0]['publisherPayment']-$data['paidAmount'][0]['paidAmount'];
		}
		elseif(!isset($data['pubAmount'][0]['publisherPayment']) && !isset($data['paidAmount'][0]['paidAmount']))
		{
			$data['due']="0";
		}
		
		$this->layout->setLayout("layout/main");
		$this->load->view('ajax_publisher_payment',$data);
	}
}
?>
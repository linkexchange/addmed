<?php 

class Cron extends MX_Controller{
	public $_accessToken = "27279045b4a6918ed646ba1f5028dd4882e33139";
	public function cronbitly(){
		$data="";
		$this->load->model('url');
		$this->load->model('user');
		$this->load->model('clicksdetail');
		$this->load->model('payments');
		$links=$this->url->getAllBitlyUrllinks();
		//echo "<pre>"; print_r($links); echo "</pre>";
	
		$createdBy="3";
		
		foreach($links as $link) :
			if($link['bitlyURL'] && $this->_accessToken) :
				$bitly_url=urlencode($link['bitlyURL']);
				$bitly_accessToken=$this->_accessToken;
				$bitly_response = json_decode(file_get_contents("https://api-ssl.bitly.com/v3/link/clicks?access_token={$bitly_accessToken}&link={$bitly_url}"));
				//echo "<pre>"; print_r($bitly_response); echo "</pre>"; exit;
				if(isset($bitly_response->data->link_clicks)){
					$link_clicks=$bitly_response->data->link_clicks;
				}
				else
				{
					$link_clicks=0;
				}
				$pastClicks=$this->clicksdetail->getTotalHitsByLinkIdNew($link['id']);

				$curClicks=0;
				$totalClicks=0;
				$advertiserPaymen=0;
				$publisherPayment=0;
				$adminPayment=0;
				if($pastClicks==0 && $link_clicks>0)
				{	
					$curClicks=$link_clicks;
					$totalClicks=$link_clicks;
				}
				else
				{
					if($link_clicks==$pastClicks)
					{
						$curClicks=0;
						$totalClicks=$link_clicks;
					}
					else
					{
						$curClicks=$link_clicks-$pastClicks;
						$totalClicks=$link_clicks;
					}
						
				}
				$adminPer=$link['percentage'];
				$pubPer=100-$adminPer;
				$advertiserPayment=$curClicks*$link['payPerLink'];
				$publisherPayment=($advertiserPayment*$pubPer)/100;
				$adminPayment=($advertiserPayment*$adminPer)/100;
				$createdDate=date("Y-m-d");
				
				if(!$this->clicksdetail->isExists($link['id'],$createdDate) && $curClicks)
				{
					$clickDetails=array(
						'publishedLinkID'=>$link['id'],
						'numberOfClicks'=>$curClicks,
						'advertiserPaynment'=>$advertiserPayment,
						'publisherPayment'=>$publisherPayment,
						'commission'=>$adminPayment,
						'createdBy'=>$createdBy,
						'createdDate'=>$createdDate
					);
					echo $result=$this->clicksdetail->add($clickDetails);
				}
			endif;
		endforeach;
		
		$publishers=$this->user->getAllPublishersID();
		//echo "<pre>"; print_r($publishers); echo "</pre>";
		foreach($publishers as $user) : 
			$totalpayments=$this->clicksdetail->getClickedLinksByUserID($user['id']);
			$payPayments=$this->payments->getPaymentDetails($user['id']);
			if(count($payPayments)>0)
			{
				//echo "<pre>"; print_r($totalpayments); echo "</pre>";
				//echo "<pre>"; print_r($payPayments); echo "</pre>";
				$billableAmt=$totalpayments[0]['publisherPayment'];
				$balanceAmt=$billableAmt-$payPayments[0]['paidAmount'];
				$paidAmt=$payPayments[0]['paidAmount'];
				$paymentsData=array(
					'paidAmount'=>$paidAmt,
					'billableAmount'=>$billableAmt,
					'balanceAmount'=>$balanceAmt,
					'updatedBy'=>'3',
					'updatedDate'=>date("Y-m-d"),
				);
				echo $this->payments->updateBalance($paymentsData,$payPayments[0]['userID']);
			}
			else
			{
				$billableAmt=$totalpayments[0]['publisherPayment'];
				$balanceAmt=$billableAmt-$payPayments[0]['paidAmount'];
				$paidAmt=$payPayments[0]['paidAmount'];
				$paymentsData=array(
					'paidAmount'=>$paidAmt,
					'billableAmount'=>$billableAmt,
					'balanceAmount'=>$balanceAmt,
					'updatedBy'=>'3',
					'updatedDate'=>date("Y-m-d"),
				);
				echo $this->payments->updateBalance($paymentsData,$payPayments[0]['userID']);
			}
		endforeach;
		
		$totalpayments="";
		$billableAmt=0;$balanceAmt=0;
		$advertisers=$this->user->getAllAdvertisersID();
		//echo "<pre>"; print_r($advertisers); echo "</pre>";
		foreach($advertisers as $user) :
			$totalpayments=$this->clicksdetail->getClickedLinksByUserID($user['id'],$adv=1);
			$payPayments=$this->payments->getPaymentDetails($user['id']);
			//echo "<pre>"; print_r($totalpayments); echo "</pre>";
			//echo "<pre>"; print_r($payPayments); echo "</pre>";
			if($totalpayments[0]['advertiserPaynment']) : 
				//update payments for the user.
				$billableAmt=$totalpayments[0]['advertiserPaynment'];
				$balanceAmt=$payPayments[0]['paidAmount']-$billableAmt;
				if($balanceAmt<0)
					$balanceAmt=0;
				$paymentsData=array(
					'billableAmount'=>$billableAmt,
					'balanceAmount'=>$balanceAmt,
					'updatedBy'=>'3',
					'updatedDate'=>date("Y-m-d"),
				);
				echo $this->payments->updateBalance($paymentsData,$payPayments[0]['userID']);
			else :
				//Don't have clicked links for user(i.e.advertiserPaynment=NULL) then proced to next record
				continue;
			endif;
		endforeach;

	}
}

?>
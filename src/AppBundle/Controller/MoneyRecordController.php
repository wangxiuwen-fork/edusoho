<?php
namespace AppBundle\Controller;

use Biz\Order\Service\MoneyService;
use Symfony\Component\HttpFoundation\Request;
use Topxia\Common\Paginator;

class MoneyRecordController extends BaseController
{
    public function indexAction(Request $request)
	{	
		$user = $this->getCurrentUser();

    	$conditions = array(
    		'userId' => $user['id'],
            'type' =>'income',
            'status' => 'finished'
		);

        $paginator = new Paginator(
            $request,
            $this->getMoneyService()->countMoneyRecords($conditions),
            15
        );
        $incomeRecords = $this->getMoneyService()->searchMoneyRecords(
        	$conditions,
        	'latest',
        	$paginator->getOffsetCount(),
        	$paginator->getPerPageCount()
    	);

		return $this->render('money-record/index.html.twig',array(
        	'incomeRecords' => $incomeRecords,
            'paginator' => $paginator
        ));
	}

	public function payoutAction(Request $request)
	{   
        $user = $this->getCurrentUser();

        $conditions = array(
            'userId' => $user['id'],
            'type' =>'payout',
            'status' => 'finished'
        );

        $paginator = new Paginator(
            $request,
            $this->getMoneyService()->countMoneyRecords($conditions),
            15
        );

        $payoutRecords = $this->getMoneyService()->searchMoneyRecords(
            $conditions,
            'latest',
            $paginator->getOffsetCount(),
            $paginator->getPerPageCount()
        );
		return $this->render('money-record/payout.html.twig',array(
            'payoutRecords' => $payoutRecords,
            'paginator' => $paginator
        ));
	}

    /**
     * @return MoneyService
     */
	protected function getMoneyService()
    {
        return $this->getBiz()->service('Order:MoneyService');
    }
}
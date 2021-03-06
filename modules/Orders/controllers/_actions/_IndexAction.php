<?php
    /**
     * Lists all Order models.
     * @return mixed
     */

namespace app\modules\Orders\controllers\_actions;

use Yii;
use yii\base\Action;
use app\modules\Orders\models\Order;
use app\models\QOrder;
use yii\web\NotFoundHttpException;
use app\models\UserHasCustomer;
use app\models\User;

class IndexAction extends Action
{
    public function run($customer = 0)
    {
        $orders_count = Order::find()
                             ->innerJoin('lv_itemsordered', '`lv_itemsordered`.`ordernumber` = `lv_salesorders`.`id`')
                             ->innerJoin('lv_locations', '`lv_locations`.`id` = `lv_salesorders`.`location_id`')
                             //->where(['lv_salesorders.ordertype' => Ordertype::findOne(['name'=>$type])->id])
                             ->where(['`lv_salesorders`.`trackingnumber`'=>null, 'lv_salesorders.deleted' => 1]);
        $quotes_order_count = QOrder::find()->select('lv_qsalesorders.*')
    			->innerJoin('lv_qitemsordered', '`lv_qitemsordered`.`ordernumber` = `lv_qsalesorders`.`id`')
                ->where(['deleted' => 1]); 
    	
    	if($customer != 0){
                $orders_count->andWhere(['`lv_salesorders`.`customer_id`'=>$customer]);
                $quotes_order_count->andWhere(['`lv_qsalesorders`.`customer_id`'=>$customer]);
    	}
    	
        $orders_count = $orders_count->groupBy('`lv_itemsordered`.`ordernumber`', '`lv_locations`.`id`')->count();
        $quotes_order_count = $quotes_order_count->groupBy('`lv_qitemsordered`.`ordernumber`')->count();  	
    	
		if(Yii::$app->user->identity->usertype===User::REPRESENTATIVE)
			$customer = UserHasCustomer::find()->where(['userid'=>Yii::$app->user->id])->one()->customerid;

			return $this->controller->render('index', [
				'customer' => $customer,
				'basket_count' => ($orders_count + $quotes_order_count)
			]);
    }
}
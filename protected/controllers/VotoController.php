<?php

class VotoController extends Controller
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionComputar(){
		session_start();
		$model=new Voto;
		
		if(isset($_POST['id_professor']) && isset($_POST['nota']))
		{
			$model->id_professor = $_POST['id_professor'];
			$model->voto = $_POST['nota'];
			$model->ip = $_SERVER["REMOTE_ADDR"];
			
			// Verificando se o usuário já votou no professor (pela sessão)
			if(isset($_SESSION['id_professor']) && $_SESSION['id_professor'] == $model->id_professor){
				echo 'PROIBIDO';
				exit;
			}
			
			// Verificando se o usuário já votou no professor (pelo IP)
			// $c = new CDbCriteria();
			// $c->condition = "id_professor = :id";
			// $c->addCondition("ip = :ip");
			// $c->params = array('id'=>$model->id_professor, 'ip'=>$model->ip);
			// $model2 = Voto::model()->find($c);
			
			if($model->save()){ //$model2 == NULL && 
				echo 'OK';
				$_SESSION['id_professor'] = $model->id_professor;
			}
			else if($model2 != NULL) echo 'PROIBIDO'; else echo 'Requisicao falhou.';
		}else{
			echo 'Requisicao falhou.';
		}
	}

	public function actionAppComputar($id_professor, $ip, $voto){
		$model=new Voto;

		$model->id_professor = $id_professor;
		$model->voto = $voto;
		$model->ip = $ip;

		// Verificando se o usuário já votou no professor (pelo IP)
		$c = new CDbCriteria();
		$c->condition = "id_professor = :id";
		$c->addCondition("ip = :ip");
		$c->params = array('id'=>$model->id_professor, 'ip'=>$model->ip);
		$model2 = Voto::model()->find($c);

		if($model2 == null){
			/* O usuàrio não votou anteriormente */
			if($model->save()){
				echo '{"msg": "Voto computado"}';
			}else{
				echo '{"msg": "Ocorreu um erro"}';
			}
		}else{
			/* Foi detectado um voto anterior do usuário */
			echo '{"msg": "Sua nota já foi computada"}';
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Voto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Voto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Voto']))
			$model->attributes=$_GET['Voto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Voto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Voto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Voto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='voto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

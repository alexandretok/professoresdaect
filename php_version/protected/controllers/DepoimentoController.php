<?php

class DepoimentoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
	public function actionNovo()
	{
		$model=new Depoimento;
		$professor = Professor::model()->findByPk($_POST['Depoimento']['id_professor']);
		if(!empty($_POST['Depoimento'])){
			if(empty($_POST['Depoimento']['nome'])) unset($_POST['Depoimento']['nome']);
			$model->attributes=$_POST['Depoimento'];
			$model->id_disciplina=empty($_POST['Depoimento']['id_disciplina']) ? null : $_POST['Depoimento']['id_disciplina'];
			if($model->save()){
				Yii::app()->user->setFlash('success', "Seu depoimento foi enviado com sucesso e está aguardando aprovação.");
				$this->redirect(Yii::app()->baseUrl . '/professor/'.$model->id_professor.'/'.URLify::filter($professor->nome));
			}
		}
	}
	
	public function actionGostei(){
		session_start();
		$id = $_POST['id_depoimento'];
		if(isset($_SESSION['id_depoimento']) && array_search($id, $_SESSION['id_depoimento']) !== FALSE){
			echo 'FAIL';
			exit;
		}
		$model = Depoimento::model()->findByPk($id);
		$atual = $model->up;
		$model->up = $atual+1;
		if($model->save()){
			echo "OK";
			$_SESSION['id_depoimento'][] = $id;
		}
	}
	
	public function actionNaogostei(){
		session_start();
		$id = $_POST['id_depoimento'];
		if(isset($_SESSION['id_depoimento']) && array_search($id, $_SESSION['id_depoimento']) !== FALSE){
			echo 'FAIL';
			exit;
		}
		$model = Depoimento::model()->findByPk($id);
		$atual = $model->down;
		$model->down = $atual+1;
		if($model->save()){
			echo "OK";
			$_SESSION['id_depoimento'][] = $id;
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Depoimento']))
		{
			$model->attributes=$_POST['Depoimento'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_depoimento));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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

	public function actionGetDepoimentos($id, $limite, $pagina){
		// Gerando lista de depoimentos
		$c = new CDbCriteria();
		$c->compare('aprovado', 1);
		$c->compare('id_professor', $id);
		$c->order = "up DESC, down ASC, id_depoimento DESC";
		$c->limit = $limite;
		$c->offset = $pagina*$limite - $limite;
		$depoimentos = Depoimento::model()->findAll($c);

		echo CJavaScript::jsonEncode($depoimentos);
		exit;
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Depoimento');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Depoimento('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Depoimento']))
			$model->attributes=$_GET['Depoimento'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Depoimento the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Depoimento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Depoimento $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='depoimento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

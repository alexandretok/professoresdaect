<?php

class ProfessorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id){
		/* @var $professor Professor */
		$professor = Professor::model()->findByPk($id);
		
		// Gerando lista de depoimentos
		$c = new CDbCriteria();
		$c->compare('aprovado', 1);
		$c->compare('id_professor', $professor->id_professor);
		$c->order = "up DESC, down ASC, id_depoimento DESC";
		$depoimentos = Depoimento::model()->findAll($c);
		
		// Buscando nota do professor
		$mediaVotos = floor(Voto::model()->model()->findBySql("SELECT AVG(voto) as voto FROM voto WHERE id_professor = '$professor->id_professor'")->attributes['voto'] * 100) / 100;
		$qtdVotos = Voto::model()->countByAttributes(array('id_professor' => $professor->id_professor));

		// Buscando as disciplinas
		$ensina = ProfessorDisciplina::model()->findAllByAttributes(array('id_professor' => $professor->id_professor));
		
		$this->render('view',array(
			'professor' => $professor,
			'depoimentos' => $depoimentos,
			'ensina' => $ensina,
			'media' => $mediaVotos,
			'qtdVotos' => $qtdVotos,
		));
	}
	
	public function actionPesquisa($search){
		$criteria = new CDbCriteria();
		$criteria->addSearchCondition('nome', $search);

		$professores = Professor::model()->findAll($criteria);

		$this->renderPartial('pesquisa', array('professores'=>$professores));
	}

	public function actionGetJsonList(){
		// $professores = Professor::model()->findAll();
		// echo CJavaScript::jsonEncode($professores);

		$list= Yii::app()->db->createCommand('SELECT professor.id_professor, nome, aprovado, foto, AVG(voto) as nota FROM professor INNER JOIN voto ON voto.id_professor = professor.id_professor GROUP BY professor.id_professor')->queryAll();
		echo CJavaScript::jsonEncode($list);	
		exit;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Professor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Professor']))
		{
			$model->attributes=$_POST['Professor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_professor));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Professor']))
		{
			$model->attributes=$_POST['Professor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_professor));
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Professor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Professor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Professor']))
			$model->attributes=$_GET['Professor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Professor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Professor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Professor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='professor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

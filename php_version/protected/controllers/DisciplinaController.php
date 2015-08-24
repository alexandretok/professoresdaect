<?php

class DisciplinaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			// 'accessControl', // perform access control for CRUD operations
			// 'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function actionTemp() {
		$profs = Professor::model()->findAll();
		foreach($profs as $prof) {
			echo "<a href='https://www.google.com.br/?gws_rd=ssl#q=sigaa+ufrn+disciplinas+".utf8_decode($prof->nome)."' target='_blank'>Google</a> - ";
			echo "<a href='profDisc/$prof->id_professor' target='_blank'>".utf8_decode($prof->nome)."</a><br/>";
		}

	}

	public function actionProfDisc($id) {
		$professor = Professor::model()->findByPk($id);
		if(is_null($professor))
			echo "Não existe esse prof";
		else
			echo $professor->nome."<br/>";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_ENCODING, "gzip");
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0");


		$url = "http://www.sigaa.ufrn.br/sigaa/public/docente/disciplinas.jsf?siape=2857826";


		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($curl);
		curl_close($curl);

		$temp = explode("anoPeriodo", $html);
		unset($temp[0]);

		$u = 0;
		foreach($temp as $periodo) {
			$tr = explode("<tr>", $periodo);
			foreach($tr as $key => $disciplina) {
				if(!$key) continue;
				$codigo = explode("codigo\">", $disciplina);
				if(count($codigo) == 1) continue;
				$codigo = explode("</td>", $codigo[1]);
				$codigo = trim($codigo[0]);
				$disc = Disciplina::model()->findByAttributes(array('id_disciplina' => $codigo));
				if(is_null($disc)){
					continue;
				}
				else{
					$tem = ProfessorDisciplina::model()->findAllByAttributes(array('id_professor' => $id, 'id_disciplina' => $codigo));
					if(!count($tem)){
						$ligacao = new ProfessorDisciplina();
						$ligacao->id_disciplina = $codigo;
						$ligacao->id_professor = $id;
						if($ligacao->save()){
							$u++;
							echo $ligacao->disciplina->nome." salva<br/>";
						}
						else{

						}
					}else{
					}
				}
			}

		}
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

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
	
	public function actionListarProfessores($id){
		$c = new CDbCriteria();
		$c->condition = 'id_disciplina = "'. $id .'"';
		$model = ProfessorDisciplina::model()->findAll($c);
		// TODO: Transformar esse model em data provider
		$this->render('professores', array('model'=>$model));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Disciplina;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Disciplina']))
		{
			$model->attributes=$_POST['Disciplina'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_disciplina));
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

		if(isset($_POST['Disciplina']))
		{
			$model->attributes=$_POST['Disciplina'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_disciplina));
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
		$dataProvider=new CActiveDataProvider('Disciplina');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Disciplina('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Disciplina']))
			$model->attributes=$_GET['Disciplina'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Disciplina the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Disciplina::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Disciplina $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='disciplina-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

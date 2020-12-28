<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\Url;
use yii\bootstrap\Tabs;

$this->title = "Reģistrs";
$this->params['breadcrumbs'][] = ['label' => 'Example', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'TP';

?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="panel panel-default" style='margin:15px 0'>
  <div class="panel-heading" role="tab" id="headingTris">
    <h4 class="panel-title">
    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTris" aria-expanded="false" aria-controls="collapseTris">
      Example
    </a>
    </h4>
  </div>
  <div id="collapseTris" class="panel-collapse collapse" role="tabpane3" aria-labelledby="headingTris">
    <div class="panel-body">
      <div style='float:left; width:220px'>

      </div>
      <div style='float:left; width:49%;'>
        <?php $form = ActiveForm::begin(); ?>

        <?php  echo $form->field($model, 'id2')->widget(Select2::classname(), [
            'showToggleAll' => false,
            'options' => ['placeholder' => 'Select...', 'multiple' => true],
            'maintainOrder' => false,
            'pluginOptions' => [
              'disabled' => true,
              'tags' => true,
              'tokenSeparators' => [',', ' ', ';'],
              'maximumInputLength' => 10,
               'dropdownAutoWidth' => 'true'
            ],
          ])->label('Pircējs');
          ?>
        <?php  echo $form->field($model, 'id3')->widget(Select2::classname(), [
            'showToggleAll' => false,
            'options' => ['placeholder' => 'Select...', 'multiple' => true],
            'maintainOrder' => false,
            'pluginOptions' => [
              'disabled' => true,
              'tags' => true,
              'tokenSeparators' => [',', ' ', ';'],
              'maximumInputLength' => 10,
               'dropdownAutoWidth' => 'true'
            ],
          ])->label('Pārdevējs');
          ?>


            <div style='clear:both'> </div>
          <div>
            <?php  echo $form->field($model, 'status')->widget(SwitchInput::classname(), [
                    'pluginOptions'=>[
                      'size' => 'small',
                      'onColor' => 'success',
                      'offColor' => 'danger',
                    ],
                    'options'=>['onchange'=>'this.form.submit()'],
                ])->label(false); ?>
            <?php ActiveForm::end(); ?>

          </div>



      </div>

    </div>
  </div>
</div>

<?php
echo Tabs::widget([
    'items' => $tabs
]);?>

<div class="panel panel-default" style='margin-top:0px; border-top:none;'>
  <div class="panel-body">



  <?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
    'rowOptions'=>function($data){
        if($data['id1']!='A'){return ['class' => 'danger'];}
        else if($data['id2']>0){return ['class' => 'success'];}
        else if($data['id3']>0){return ['class' => 'info'];}

    },
		'columns' => array_merge(
      [
               [
                   'class' => 'yii\grid\CheckboxColumn',
                   'name' => 'example[]',
                   'checkboxOptions' => function($data){return ["value" => $data['ID']];}
               ]
      ],
      [
        'id1',
        'id2',
        'id3',
        'id4',
      ],

    ),


]); ?>

</div>
</div>

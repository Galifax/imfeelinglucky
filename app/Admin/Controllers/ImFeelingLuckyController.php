<?php

namespace App\Admin\Controllers;

use App\Models\ImFeelingLucky;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ImFeelingLuckyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ImFeelingLucky';

    public static bool $displayInNavigation = false;
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ImFeelingLucky());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('number', __('Number'));
        $grid->column('sum', __('Sum'));
        $grid->column('total', __('Total'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ImFeelingLucky::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('number', __('Number'));
        $show->field('sum', __('Sum'));
        $show->field('total', __('Total'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ImFeelingLucky());

        $form->text('user_id', __('User id'));
        $form->number('number', __('Number'));
        $form->decimal('sum', __('Sum'));
        $form->decimal('total', __('Total'));

        return $form;
    }
}

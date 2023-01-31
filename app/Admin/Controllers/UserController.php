<?php

namespace App\Admin\Controllers;

use App\Models\ImFeelingLucky;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('username', __('Username'));
        $grid->column('phonenumber', __('Phonenumber'));
        $grid->column('token', __('Token'));
        $grid->column('expired_at', __('Expired at'));
        $grid->column('created_at', __('Created at'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('phonenumber', __('Phonenumber'));
        $show->field('token', __('Token'));
        $show->field('expired_at', __('Expired at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->imFeelingLuckies('ImFeelingLucky information', function ($imFeelingLucky) {

            $imFeelingLucky->setResource('/admin/im-feeling-luckies');

            $imFeelingLucky->number();
            $imFeelingLucky->sum();
            $imFeelingLucky->total();
            $imFeelingLucky->created_at();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('username', __('Username'));
        $form->number('phonenumber', __('Phonenumber'));
        $form->text('token', __('Token'));
        $form->datetime('expired_at', __('Expired at'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}

<?php

namespace App\Admin\Controllers;

use App\Staff;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class StaffController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Staff';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Staff());
        $grid->id('ID')->sortable();
        $grid->column('name');

        $grid->picture('picture')->image();
        $grid->column('email');

        $grid->active()->value(function ($active) {
            return $active ?
                "<i class='fa fa-check' style='color:green'></i>" :
                "<i class='fa fa-close' style='color:red'></i>";
        });

        $grid->column('age');

        $grid->created_at();
        $grid->updated_at();

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
        $show = new Show(Staff::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Staff());
        $form->display('id', 'ID');

        $form->text('name');
        $form->textarea('description');
        $form->image('picture');
        $form->text('email');
        $form->switch('active');
        $form->slider('age')->options(['max' => 100, 'min' => 1, 'step' => 1, 'postfix' => 'years old']);

        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');




        return $form;
    }
}

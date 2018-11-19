<?php
/**
 * Created by PhpStorm.
 * User: Yao
 * Date: 2018/11/19
 * Time: 12:53
 */
?>

@extends('layouts.manage')

@section('content')

    <div class="columns">
        <div class="column">
            <h1 class="title">{{ __('Add New Permission') }}</h1>
        </div>
        <div class="column"></div>
    </div>

    <div class="columns">
        <div class="column is-one-third">

            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf

                <div class="block" >
                    <b-radio v-model="permissionType" name="permission_type" native-value="basic">{{ __('Basic') }}</b-radio>
                    <b-radio v-model="permissionType" name="permission_type" native-value="crud">{{ __('CRUD') }}</b-radio>
                </div>

                <div class="block" v-if="permissionType == 'basic'">

                <div class="field">
                    <label for="display_name" class="label">{{ __('Display Name') }}</label>
                    <p class="control">
                        <input type="text" name="display_name" class="input" id="display_name">
                    </p>
                </div>

                <div class="field">
                    <label for="slug" class="label">{{ __('Slug') }}</label>
                    <p class="control">
                        <input type="text" name="slug" class="input" id="slug">
                    </p>
                </div>

                <div class="field">
                    <label for="description" class="label">{{ __('Description') }}</label>
                    <p class="control">
                        <input type="text" name="description" class="input" id="description">
                    </p>
                </div>

                </div>

                <div class="field" v-if="permissionType == 'crud'">

                    <label for="resource" class="label">{{ __('Resource') }}</label>

                    <p class="control">
                        <input v-model="resource" type="text" name="resource" id="resource" class="input">
                    </p>

                    <hr>

                        <div class="block" >
                            <b-checkbox v-model="crudSelected"
                                        native-value="create">
                                {{ __('Create') }}
                            </b-checkbox>
                            <b-checkbox v-model="crudSelected"
                                        native-value="read">
                                {{ __('Read') }}
                            </b-checkbox>
                            <b-checkbox v-model="crudSelected"
                                        native-value="update">
                                {{ __('Update') }}
                            </b-checkbox>
                            <b-checkbox v-model="crudSelected"
                                        native-value="delete">
                                {{ __('Delete') }}
                            </b-checkbox>
                        </div>

                </div>

                <div class="field">

                    <input type="hidden" name="curd_selected" :value="crudSelected">
                    <button class="button is-primary">{{ __('Submit') }}</button>
                </div>

            </form>

        </div>

        <div class="column">
            <h2 class="subtitle">Preview</h2>

            <table class="table is-fullwidth" v-if="resource.length > 2 && crudSelected.length > 0">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Description') }}</th>
                    </tr>
                </thead>
                <tbody >
                    <tr v-for="item in crudSelected">
                        <td style="text-transform: capitalize;" v-text="crudName(item)"></td>
                        <td v-text="crudSlug(item)"></td>
                        <td v-text="crudDescription(item)"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
<script>

    var app = new Vue({
        el: "#app",
        data: {
            permissionType: 'basic',
            resource: '',
            crudSelected: ['create', 'read', 'update', 'delete']
        },
        methods: {
            crudName: function (item) {
                return item + " " + app.resource;
            },
            crudSlug: function (item) {

                return item.toLowerCase() + '-' + app.resource.toLowerCase();
            },
            crudDescription: function (item) {

                return "Allow a user to " + item.toUpperCase() + ' a ' + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1).toLowerCase();
            }
        }
    });

</script>
@endsection

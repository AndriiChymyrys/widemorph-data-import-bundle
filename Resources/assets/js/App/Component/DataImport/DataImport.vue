<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Import Data For Entity <b>{{ entityReflection.namespace }}</b></h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>Entity Field Name</th>
                    <th>Field Description</th>
                    <th>Mapping</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="field in entityReflection.fields">
                    <td>{{ field.name }}</td>
                    <td>
                        <component :is="getComponent(field.viewType, 'desc')"
                                   v-bind="getComponentProperties('desc', field)"></component>
                    </td>
                    <td>
                        <component :is="getComponent(field.viewType, 'mapp')"
                                   v-bind="getComponentProperties('mapp', field)"></component>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <div class="row">
                <div class="col-6">
                    <file-input/>
                </div>
                <div class="col-6 text-right">
                    <import-buttons/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TextMapping from "./FieldView/TextMapping";
import TextDescription from "./FieldView/TextDescription";
import ManytooneMapping from "./FieldView/ManytooneMapping";
import ManytooneDescription from "./FieldView/ManytooneDescription";
import FileInput from "./FieldView/FileInput";
import ImportButtons from "./FieldView/ImportButtons";

const DEFAULT_FIELD_VIEW_TYPE = 'text';

export default {
    props: ['entityReflection'],
    name: 'DataImport',
    components: {
        FileInput,
        ImportButtons,
        TextMapping,
        TextDescription,
        ManytooneMapping,
        ManytooneDescription,
    },
    data() {
        return {
            componentMapping: {
                manytoone: {
                    desc: ManytooneDescription,
                    mapp: TextMapping // TODO: change to ManytooneMapping
                },
                text: {
                    desc: TextDescription,
                    mapp: TextMapping
                }
            }
        };
    },
    methods: {
        getComponent(viewType, type) {
            if (viewType in this.componentMapping) {
                return this.componentMapping[viewType][type];
            }

            return this.componentMapping[DEFAULT_FIELD_VIEW_TYPE][type];
        },
        getComponentProperties(type, field) {
            if (type === 'desc') {
                return {'field': field}
            }

            return {'namespace': this.entityReflection.namespace, 'fieldName': field.name}
        }
    }
}
</script>

<template>
    <div>
        <textarea :name="name"
                  class="control__field"
                  :id="id"
                  :placeholder="placeholder"
                  cols="30"
                  rows="15">{{ value }}</textarea>
    </div>
</template>

<style>
    .CodeMirror {
        border: 1px solid #999;
        border-radius: 4px;
    }
</style>

<script>
    import CodeMirror from "codemirror/lib/codemirror";
    import emmet from '@emmetio/codemirror-plugin';

    emmet(CodeMirror);

    import "codemirror/lib/codemirror.css";
    import "codemirror/mode/htmlmixed/htmlmixed";

    import "codemirror/addon/hint/show-hint";
    import "codemirror/addon/hint/show-hint.css";

    import "codemirror/addon/hint/html-hint";
    import "codemirror/addon/scroll/simplescrollbars";
    import "codemirror/addon/scroll/simplescrollbars.css";

    import "codemirror/addon/search/search";
    import "codemirror/addon/search/searchcursor";
    import "codemirror/addon/search/jump-to-line";

    import "codemirror/addon/dialog/dialog";
    import "codemirror/addon/dialog/dialog.css";

    import "codemirror/addon/display/fullscreen";
    import "codemirror/addon/display/fullscreen.css";
    import "codemirror/addon/display/placeholder";

    import "codemirror/addon/display/rulers";

    import "codemirror/addon/selection/active-line";

    import "codemirror/addon/edit/closetag";
    import "codemirror/addon/edit/matchtags";
    import "codemirror/addon/edit/closebrackets";

    import "codemirror/addon/fold/foldgutter"
    import "codemirror/addon/fold/foldgutter.css"
    import "codemirror/addon/fold/foldcode"

    import "codemirror/theme/neo.css";

    export default {
        props: {
            value: {
                type: String,
                default: ''
            },
            name: {
                type: String,
                required: true
            },
            id: {
                type: String,
                required: true
            },
            placeholder: {
                type: String,
                default: ''
            }
        },
        data() {
            return {
                codeMirror: null,
                options: {
                    mode: "htmlmixed",
                    theme: "neo",
                    scrollbarStyle: "simple",
                    viewportMargin: Infinity,
                    lineNumbers: true,
                    lineWrapping: true,

                    foldGutter: true,
                    gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],

                    line: true,
                    styleActiveLine: true,
                    autoCloseTags: true,
                    matchTags: {
                        bothTags: true
                    },
                    autoCloseBrackets: true,

                    markTagPairs: true,
                    autoRenameTags: true,

                    extraKeys: {
                        'Ctrl-Space': 'autocomplete',
                        "Ctrl-J": "toMatchingTag",
                        "F11": function(cm) {
                            cm.setOption("fullScreen", !cm.getOption("fullScreen"));
                        },
                        "Esc": function(cm) {
                            if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
                        },
                        'Tab': 'emmetExpandAbbreviation',
                        'Enter': 'emmetInsertLineBreak',
                        "Ctrl-Q": function(cm){
                            cm.foldCode(cm.getCursor());
                        }
                    }
                }
            };
        },
        mounted() {
            let textarea = document.getElementById(this.id);
            this.codeMirror = CodeMirror.fromTextArea(textarea, this.options);
        }
    }
</script>

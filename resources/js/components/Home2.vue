<template>
<b-container class="justify-content-center">
    <editor-menu-bar :editor="editor" v-slot="{ commands, isActive, focused }">
        <div class="py-3" :class="{ 'is-focused': focused }" v-show="focused">
            <b-button
                :pressed="isActive.bold()"
                @click="commands.bold"
            >
                <b-icon-type-bold />
            </b-button>

            <b-button
                :pressed="isActive.italic()"
                @click="commands.italic"
            >
                <b-icon-type-italic />
            </b-button>

            <b-button
                :pressed="isActive.strike()"
                @click="commands.strike"
            >
                <b-icon-type-strikethrough />
            </b-button>

            <b-button
                :pressed="isActive.underline()"
                @click="commands.underline"
            >
                <b-icon-type-underline />
            </b-button>

            <b-button
                :pressed="isActive.code()"
                @click="commands.code"
            >
                <b-icon-code />
            </b-button>

            <b-button
                :pressed="isActive.paragraph()"
                @click="commands.paragraph"
            >
                <b-icon-chat />
            </b-button>

            <b-button
                :pressed="isActive.heading({ level: 1 })"
                @click="commands.heading({ level: 1 })"
            >
                H1
            </b-button>

            <b-button
                :pressed="isActive.heading({ level: 2 })"
                @click="commands.heading({ level: 2 })"
            >
                H2
            </b-button>

            <b-button
                :pressed= "isActive.heading({ level: 3 })"
                @click="commands.heading({ level: 3 })"
            >
                H3
            </b-button>

            <b-button
                :pressed="isActive.bullet_list()"
                @click="commands.bullet_list"
            >
                <b-icon-list-ul />
            </b-button>

            <b-button
                :pressed="isActive.ordered_list()"
                @click="commands.ordered_list"
            >
                <b-icon-list-ol />
            </b-button>

            <b-button
                :pressed="isActive.blockquote()"
                @click="commands.blockquote"
            >
                <b-icon-chat-square-quote />
            </b-button>

            <b-button
                :pressed="isActive.code_block()"
                @click="commands.code_block"
            >
                <b-icon-code />
            </b-button>

            <b-button
                @click="commands.horizontal_rule"
            >
                <b-icon-hr />
            </b-button>

            <b-button
                @click="commands.undo"
            >
                <b-icon-skip-backward />
            </b-button>

            <b-button
                @click="commands.redo"
            >
                <b-icon-skip-forward />
            </b-button>
            <b-button
                @click="commands.createTable({rowsCount: 3, colsCount: 3, withHeaderRow: true })"
            >
                <b-icon-table />
            </b-button>
            <br />
            <span v-if="isActive.table()">
                <b-button
                    @click="commands.deleteTable"
                >
                    del
                </b-button>
                <b-button
                    @click="commands.addColumnBefore"
                >
                    add col before
                </b-button>
                <b-button
                    @click="commands.addColumnAfter"
                >
                    add col after
                </b-button>
                <b-button
                    @click="commands.deleteColumn"
                >
                    del col
                </b-button>
                <b-button
                    @click="commands.addRowBefore"
                >
                    add row before
                </b-button>
                <b-button
                    @click="commands.addRowAfter"
                >
                    add row after
                </b-button>
                <b-button
                    @click="commands.deleteRow"
                >
                    del row
                </b-button>
                <b-button
                    @click="commands.toggleCellMerge"
                >
                    merge cells
                </b-button>
            </span>
        </div>
    </editor-menu-bar>

    <editor-content class="py-3" :editor="editor" />


</b-container>
</template>

<script>
    import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
    import {
        Blockquote,
        CodeBlock,
        HardBreak,
        Heading,
        HorizontalRule,
        OrderedList,
        BulletList,
        ListItem,
        TodoItem,
        TodoList,
        Bold,
        Code,
        Italic,
        Link,
        Strike,
        Underline,
        History,
        Table,
        TableHeader,
        TableCell,
        TableRow
    } from 'tiptap-extensions'
    export default {
        components: {
            EditorContent,
            EditorMenuBar
        },
        data() {
            return {
                editor: new Editor({
                    extensions: [
                        new Blockquote(),
                        new BulletList(),
                        new CodeBlock(),
                        new HardBreak(),
                        new Heading({ levels: [1, 2, 3] }),
                        new HorizontalRule(),
                        new ListItem(),
                        new OrderedList(),
                        new TodoItem(),
                        new TodoList(),
                        new Link(),
                        new Bold(),
                        new Code(),
                        new Italic(),
                        new Strike(),
                        new Underline(),
                        new History(),
                        new Table({
                            resizable: true,
                        }),
                        new TableHeader(),
                        new TableCell(),
                        new TableRow(),
                    ],
                    content: `
          <h2>
            Hi there,
          </h2>
        `,
                }),
            }
        },
        beforeDestroy() {
            this.editor.destroy()
        },
    }
</script>

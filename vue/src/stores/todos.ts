import Config from "@/config"
import { defineStore } from 'pinia'
import { mande } from 'mande'

var api = mande(Config.API_URL)

export const todos = defineStore('todos', {
  state: () => ({
    current: "",
    /** @type {{ text: string, id: number, isFinished: boolean, created_at: number }[]} */
    todos: [],
  }),
  getters: {
    allTodos(state: any) {
      return [...this.unfinishedTodos, ...this.finishedTodos]
    },
    finishedTodos(state: any) {
      // autocompletion! ✨
      return state.todos.filter((todo: any) => todo.isFinished)
    },
    unfinishedTodos(state: any) {
      return state.todos.filter((todo: any) => !todo.isFinished)
    },
  },
  actions: {
    setTodos(todos: any) {
      if (todos !== null) {
        this.todos = todos
      }
    },
    fetchTodos() {
      api
        .get("/todo/item/list")
        .then((data) => {
          this.setTodos(data.items)
        })
    },
    changeFinished(id: number) {
      api
        .post("/todo/item/edit/" + id)
        .then((data) => {
          this.setTodos(data.items)
        })
    },
    addCurrent() {
      if (this.current.length < 1) {
        return
      }

      api
        .post("/todo/item/new/" + this.current)
        .then((data) => {
          this.current = ""
          this.setTodos(data.items)
        })
    },
    setCurrent(text: string) {
      this.current = text
    },
  },
})
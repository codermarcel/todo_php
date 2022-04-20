<script lang="ts">
import { todos } from "@/stores/todos"
import { ref } from "vue"

export default {
  setup() {
    const store = todos()

    return {
      store,
    }
  },
  mounted() {
    this.store.fetchTodos()
  },
}
</script>

<template>
  <div class="all">
    <h1>All Todos ({{ store.allTodos.length }})</h1>

    <ul>
      <li
          v-for="todo in store.allTodos"
          @click="store.changeFinished(todo.id)"
          :class="{'finn': todo.isFinished}"
          :key="todo.id"
      >{{ todo.text }}</li>
    </ul>




  </div>
</template>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
ul {
  font-size: 1.5em;
}
.finn {
  opacity: 0.3;
  /*color: red;*/
  text-decoration: line-through;
}
</style>

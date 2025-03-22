<script lang="ts">
  import type { FullAutoFill, HTMLInputAttributes } from "svelte/elements";

  interface Props extends HTMLInputAttributes{
      value?: string;
      type?: string;
      id?: string;
      class?: string;
      required?: boolean;
      autocomplete?: FullAutoFill | null | undefined;
  }

  let {
      value = $bindable(),
      type = "text",
      id = "",
      class: className = "",
      required = false,
      autocomplete,
  }: Props = $props();

  let input: HTMLInputElement;

  $effect(() => {
      if (input) {
          input.focus();
      }
  });

  export function focus() {
      input?.focus();
  }
</script>

<input
    {type}
    {id}
    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 {className}"
    bind:value
    bind:this={input}
    {required}
    {autocomplete}
/>

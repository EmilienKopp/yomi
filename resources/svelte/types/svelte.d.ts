declare module 'svelte' {
  export type Snippet = any;
  
  export function $state<T>(initialValue: T): T;
  export function $derived<T>(expression: T): T;
  export function $props<T>(): T;
  export function $effect(callback: () => void | (() => void)): void;
}

declare module '@inertiajs/svelte' {
  export function Link(props: any): any;
  export function useForm<T>(data: T): any;
  export function usePage(): any;
  export function createInertiaApp(options: any): any;
}

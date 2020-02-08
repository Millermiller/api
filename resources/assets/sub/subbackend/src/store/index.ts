import Vue from 'vue';
import * as Vuex from 'vuex';
import { createStore, Module } from 'vuex-smart-module';
import { root } from './modules/root';

Vue.use(Vuex);

export const store = createStore(
  root, {
    strict: process.env.NODE_ENV !== 'production',
  },
);

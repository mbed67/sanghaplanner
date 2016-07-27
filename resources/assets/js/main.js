import React from 'react';
import { render } from 'react-dom';
import { Provider } from 'react-redux';
import App from './containers/App';
import sanghaStore from './store/sanghaStore';

const store = sanghaStore(); //called without initialState so the reducers will use their own value of initialState

//Provider makes sure the root component will get access to the store
render(
    <Provider store = { store }>
        <App />
    </Provider>,
    document.getElementById('sangha-react')
);

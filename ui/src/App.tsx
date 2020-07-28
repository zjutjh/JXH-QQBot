import React from 'react';
import {HeaderBar} from './components/HeaderBar'
import {DictionaryList} from './components/WordDictionaryList'
import logo from './fabric.png';


export const App: React.FunctionComponent = () => {
    return (
        <div>
            <DictionaryList/>
        </div>
    );
};

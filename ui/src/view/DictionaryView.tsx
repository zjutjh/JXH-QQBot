import React from 'react';
import logo from './fabric.png';
import {Image} from 'office-ui-fabric-react/lib/Image';
import {DictionaryList} from "../components/WordDictionaryList";

export const DictioaryView: React.FunctionComponent = () => {
    return (
        <div>
            <DictionaryList></DictionaryList>

        </div>
    );
};

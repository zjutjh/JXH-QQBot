import React from 'react';
import logo from './fabric.png';
import {Image} from 'office-ui-fabric-react/lib/Image';
import {BanDictionaryList} from "../components/BanDictionaryList";
import {PrimaryButton} from "office-ui-fabric-react";

export const BlackListView: React.FunctionComponent = () => {
    return (
        <div>
            <PrimaryButton style={{margin: "1rem"}} text="Add" allowDisabledFocus/>
            <BanDictionaryList></BanDictionaryList>
        </div>
    );
};

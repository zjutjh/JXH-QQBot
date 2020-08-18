import React from "react";
import {NavBar} from "../components/NavBar";
import {Route, Switch} from "react-router";
import {DictionaryList} from "../components/WordDictionaryList";
import {App} from "../App";

export const DashBoard: React.FunctionComponent = () => {
    return (
        <div style={{paddingTop: "50px", display: "flex", flexWrap: "wrap"}}>

            <NavBar/>
            <Switch>
                <div style={{width: "calc(100% - 375px)", minWidth: "400px"}}>
                    <Route path="/dictionary" component={DictionaryList}/>
                </div>

            </Switch>

        </div>

    )
}
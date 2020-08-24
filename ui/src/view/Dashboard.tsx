import React from "react";
import {NavBar} from "../components/NavBar";
import {Route, Switch} from "react-router";
import {DictionaryList} from "../components/WordDictionaryList";
import {App} from "../App";
import {DictioaryView} from "./DictionaryView";
import {BlackListView} from "./BlackListView";

export const DashBoard: React.FunctionComponent = () => {
    return (
        <div style={{paddingTop: "50px", display: "flex", flexWrap: "wrap"}}>

            <NavBar/>
            <Switch>
                <div style={{width: "100%", minWidth: "400px", maxWidth: "800px"}}>
                    <Route path="/dictionary" component={DictioaryView}/>
                    <Route path="/black-list" component={BlackListView}/>
                </div>

            </Switch>

        </div>

    )
}
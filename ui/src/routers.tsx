import {Route, Router, Switch} from "react-router";
import {App} from "./App";
import {AboutView} from "./view/AboutView";
import {LoginView} from "./view/LoginView";
import React from "react";
import {BrowserRouter, HashRouter} from "react-router-dom";
import {DashBoard} from "./view/Dashboard";

export default () => (
    <HashRouter>
        <Route path="/">
            <App>
                <Switch>
                    <Route exact path="/about" component={AboutView}/>
                    <Route exact path="/login" component={LoginView}/>
                    <Route path="/">
                        <DashBoard>
                            <Route path="/examples"/>
                        </DashBoard>
                    </Route>
                </Switch>

            </App>
        </Route>
    </HashRouter>

);
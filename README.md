## visualize-gitlabci

A command-line tool to visualize Gitlab-CI pipeline by parsing .gitlabci.yml file of your repo. When you execute the `visualize-gitlabci` command in the root folder of your repository, It will generate the visiual representations of the pipelines of the branches. B

Please check the screenshots of the command executed in this repository and the screenshot of the pipeline of this repository on [Gitlab.Com](https://gitlab.com/umutphp/visualize-gitlabci/pipelines).

### Sample Executions

#### Execution For This Repository
The screenshot below is taken by executing the command in this repository. 
![The result of visualize-gitlabci](./examples/screenshot-1.png?raw=true "The result of visualize-gitlabci")

The screenshot below is taken from the pipeline created by Gitlab for `master` branch (from [Gitlab.Com](https://gitlab.com/umutphp/visualize-gitlabci/pipelines)).

![The pipeline](./examples/screenshot-2.png?raw=true "The pipeline of visualize-gitlabci")

#### Execution For Some Samples

##### Example 1
The result when the command is executed under `./examples/example1/` folder in this repository is as follows. Please check the [gitlab-ci.yml](./examples/example1/gitlab-ci.yml) file under the folder.

![Example #1](./examples/example1/screenshot.png?raw=true "Example #1")

##### Example 2
The result when the command is executed under `./examples/example2/` folder in this repository is as follows. Please check the [gitlab-ci.yml](./examples/example2/gitlab-ci.yml) file under the folder.

![Example #2](./examples/example2/screenshot.png?raw=true "Example #2")

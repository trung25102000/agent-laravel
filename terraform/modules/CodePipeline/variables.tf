variable "pipeline_name" {
  description = "Name of the CodePipeline."
  type        = string
}

variable "pipeline_role_arn" {
  description = "IAM role ARN assumed by CodePipeline."
  type        = string
}

variable "artifact_bucket" {
  description = "S3 bucket used by CodePipeline as the artifact store."
  type        = string
}

variable "source_bucket" {
  description = "S3 bucket that contains the deployment artifact."
  type        = string
}

variable "source_object_key" {
  description = "S3 object key for the deployment artifact zip."
  type        = string
}

variable "poll_for_source_changes" {
  description = "Whether the S3 source action polls for changes."
  type        = bool
  default     = false
}

variable "codedeploy_application_name" {
  description = "CodeDeploy application name."
  type        = string
}

variable "codedeploy_deployment_group_name" {
  description = "CodeDeploy deployment group name."
  type        = string
}

variable "tags" {
  description = "Optional tags applied to the pipeline."
  type        = map(string)
  default     = {}
}

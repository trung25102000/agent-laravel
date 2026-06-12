variable "aws_region" {
  description = "AWS region used by the provider."
  type        = string
}

variable "aws_profile" {
  description = "Named AWS CLI profile to use. Set to null to use environment credentials."
  type        = string
  default     = null
}

variable "s3_bucket_name" {
  description = "S3 bucket name to create for this environment."
  type        = string
}

variable "enable_codepipeline" {
  description = "Set true to create the CodePipeline module resources."
  type        = bool
  default     = false
}

variable "codepipeline_name" {
  description = "CodePipeline name."
  type        = string
  default     = "seo-web-pipeline"
}

variable "codepipeline_role_arn" {
  description = "IAM role ARN assumed by CodePipeline."
  type        = string
  default     = ""
}

variable "codepipeline_source_object_key" {
  description = "Artifact object key in S3 for the source stage."
  type        = string
  default     = "artifacts/seo-web.zip"
}

variable "codepipeline_poll_for_source_changes" {
  description = "Whether the S3 source action polls for changes."
  type        = bool
  default     = false
}

variable "codedeploy_application_name" {
  description = "CodeDeploy application name."
  type        = string
  default     = ""
}

variable "codedeploy_deployment_group_name" {
  description = "CodeDeploy deployment group name."
  type        = string
  default     = ""
}

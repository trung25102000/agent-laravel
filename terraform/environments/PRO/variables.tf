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

variable "create_s3_bucket" {
  description = "Set false to reuse an existing S3 bucket instead of creating it."
  type        = bool
  default     = true
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

variable "codepipeline_role_name" {
  description = "IAM role name created for CodePipeline."
  type        = string
  default     = "seo-web-codepipeline-role"
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
  default     = "seo-web"
}

variable "codedeploy_deployment_group_name" {
  description = "CodeDeploy deployment group name."
  type        = string
  default     = "seo-web-production"
}

variable "codedeploy_service_role_name" {
  description = "IAM service role name created for CodeDeploy."
  type        = string
  default     = "seo-web-codedeploy-role"
}

variable "codedeploy_deployment_config_name" {
  description = "CodeDeploy deployment config name."
  type        = string
  default     = "CodeDeployDefault.OneAtATime"
}

variable "codedeploy_target_tag_key" {
  description = "EC2 tag key used by CodeDeploy to select target instances."
  type        = string
  default     = "Name"
}

variable "codedeploy_target_tag_value" {
  description = "EC2 tag value used by CodeDeploy to select target instances."
  type        = string
  default     = "seo-web-production"
}

variable "codedeploy_target_tag_type" {
  description = "CodeDeploy EC2 tag filter type."
  type        = string
  default     = "KEY_AND_VALUE"
}

variable "enable_ec2" {
  description = "Set true to create an EC2 instance for deployment."
  type        = bool
  default     = false
}

variable "ec2_instance_name" {
  description = "EC2 instance name."
  type        = string
  default     = "seo-web-production"
}

variable "ec2_ami_id" {
  description = "AMI ID for the EC2 instance."
  type        = string
  default     = ""
}

variable "ec2_instance_type" {
  description = "EC2 instance type."
  type        = string
  default     = "t3.micro"
}

variable "ec2_subnet_id" {
  description = "Subnet ID for the EC2 instance."
  type        = string
  default     = ""
}

variable "ec2_vpc_security_group_ids" {
  description = "Security group IDs attached to the EC2 instance."
  type        = list(string)
  default     = []
}

variable "ec2_associate_public_ip_address" {
  description = "Whether the EC2 instance should have a public IP."
  type        = bool
  default     = true
}

variable "ec2_key_name" {
  description = "Optional EC2 key pair name."
  type        = string
  default     = null
}

variable "ec2_iam_instance_profile" {
  description = "Optional IAM instance profile name for the EC2 instance."
  type        = string
  default     = null
}

variable "ec2_user_data" {
  description = "Optional user data script for the EC2 instance."
  type        = string
  default     = null
}

variable "ec2_root_volume_size" {
  description = "Root EBS volume size in GiB."
  type        = number
  default     = 20
}

variable "ec2_root_volume_type" {
  description = "Root EBS volume type."
  type        = string
  default     = "gp3"
}

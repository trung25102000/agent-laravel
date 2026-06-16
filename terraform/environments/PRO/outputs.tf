output "aws_account_id" {
  description = "AWS account ID for the active credentials."
  value       = data.aws_caller_identity.current.account_id
}

output "aws_caller_arn" {
  description = "ARN for the active IAM user or role."
  value       = data.aws_caller_identity.current.arn
}

output "aws_region" {
  description = "Resolved AWS region for the provider."
  value       = data.aws_region.current.name
}

output "s3_bucket_name" {
  description = "Created S3 bucket name."
  value       = module.s3.bucket_name
}

output "s3_bucket_arn" {
  description = "Created S3 bucket ARN."
  value       = module.s3.bucket_arn
}

output "codepipeline_name" {
  description = "Created CodePipeline name when enabled."
  value       = var.enable_codepipeline ? module.codepipeline[0].pipeline_name : null
}

output "codepipeline_arn" {
  description = "Created CodePipeline ARN when enabled."
  value       = var.enable_codepipeline ? module.codepipeline[0].pipeline_arn : null
}

output "codepipeline_role_arn" {
  description = "Created IAM role ARN for CodePipeline when enabled."
  value       = var.enable_codepipeline ? module.iam[0].codepipeline_role_arn : null
}

output "codedeploy_application_name" {
  description = "Created CodeDeploy application name when enabled."
  value       = var.enable_codepipeline ? module.codedeploy[0].application_name : null
}

output "codedeploy_deployment_group_name" {
  description = "Created CodeDeploy deployment group name when enabled."
  value       = var.enable_codepipeline ? module.codedeploy[0].deployment_group_name : null
}

output "codedeploy_service_role_arn" {
  description = "Created IAM service role ARN for CodeDeploy when enabled."
  value       = var.enable_codepipeline ? module.iam[0].codedeploy_service_role_arn : null
}

output "ec2_instance_id" {
  description = "Created EC2 instance ID when enabled."
  value       = var.enable_ec2 ? module.ec2[0].instance_id : null
}

output "ec2_private_ip" {
  description = "Created EC2 instance private IP when enabled."
  value       = var.enable_ec2 ? module.ec2[0].private_ip : null
}

output "ec2_public_ip" {
  description = "Created EC2 instance public IP when enabled."
  value       = var.enable_ec2 ? module.ec2[0].public_ip : null
}
